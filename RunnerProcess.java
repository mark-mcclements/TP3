import java.io.*;
import java.util.Iterator;
import java.util.Random;
import java.util.concurrent.atomic.AtomicInteger;
import java.util.logging.Level;
import java.util.logging.Logger;
import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

class RunnerProcess implements Runnable {
    private int id;
    private String runnerID;
    
    public RunnerProcess(int id, String runnerID){
        this.id = id;
        this.runnerID = runnerID;
        System.out.println("ID: " + id + "RiD: " + runnerID);
    }

    public void run() {
        Main.runnerCounter.incrementAndGet();
        
        
        String nameOfRace = null;
        String theYear = null;
        final String runnerURL ="http://www.scottishhillracing.co.uk/RunnerDetails.aspx?FromSearch=true&RunnerID=" + runnerID;
        Document doc = null;
        try {
            doc = Jsoup.connect(runnerURL).timeout(0).get();
        } catch (IOException ex) {
            System.out.println("READ TIMED OUT...");
            Main.lblError.setText("READ TIMED OUT...");
            Main.ranScrape = false;
        }
        Element racesRan = doc.select("span[id=lblGridRacesRun]").first();
        Element table = doc.select("table[id=dgRunnerResults]").first();
        Elements links = doc.select("a[href*=RaceDetails]");
        String linkContent = links.outerHtml();
        
        String raceID = linkContent.substring(33,40);

        
        
        String racesSplit = racesRan.text();
        if(racesSplit.contains("races"))
            racesSplit = racesSplit.replace(" races","");
        else
            racesSplit = racesSplit.replace(" race", "");
        
        int ran = Integer.parseInt(racesSplit);
        
        Iterator<Element> position = table.select("td[width=50]").iterator();
        Iterator<Element> raceName = table.select("td[width=275]").iterator();
        Iterator<Element> dateOfRace = table.select("td[width=80]").iterator();
        Iterator<Element> timeOfRace = table.select("td[width=60]").iterator();
        Iterator<Element> percentWin = table.select("td[width=95]").iterator();
       
        String content = "Position, RaceName,Date,Time,Winner\n";
        
        for(int i = 0; i < ran; i++){
            String name = raceName.next().text();
            String year = dateOfRace.next().text();
            String avgWin = percentWin.next().text();
            avgWin = avgWin.substring(0, avgWin.length()-1);
           
            content += position.next().text();
            if(name.contains(","))
                name = name.replace(","," ");
            content += "," + name;
            content += "," + year;
            content += "," + timeOfRace.next().text();
            content += "," + avgWin;
            if(i != (ran-1))
                content += "\n";
            nameOfRace = name;
            String[] yearSplit = year.split("/");
            theYear = yearSplit[2];
            
        }
        
        //System.out.print(content);
        Main.deleteOldCsv("CSVFiles/Individual/" + runnerID);
        Main.writeOutCsv("CSVFiles/Individual/" + runnerID, content);
        
        //test.raceSet.add(theYear+"."+raceID);     
        Main.raceSet.add(raceID);

        Main.runnerCounter.decrementAndGet();
        Main.lblScrape.setText(Main.runnerCounter.get() + " left to process");
        if(Main.runnerCounter.get() == 0){
            Main.GenerateRaces(Main.raceSet);
        }
    
    }
}