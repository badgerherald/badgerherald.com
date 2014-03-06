<?php
try {
    $dbh = new PDO("mysql:host=localhost;dbname=student_choice_2014");
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    
    $dbh->exec('DROP TABLE IF EXISTS Quiz');
    $dbh->exec('DROP TABLE IF EXISTS Questions');
    $dbh->exec('DROP TABLE IF EXISTS Options');
    $dbh->exec('DROP TABLE IF EXISTS Participants');
    $dbh->exec('DROP TABLE IF EXISTS Votes');
    
    $dbh->exec(
        'CREATE TABLE Quiz (
          idname TEXT PRIMARY KEY,
          name TEXT
        )'  
    );
    $dbh->exec('INSERT INTO Quiz(idname, name) VALUES ("student-choice-2014", "Student Choice 2014 Nominations")');
    
    $dbh->exec(
        'CREATE TABLE Questions (
          id INTEGER PRIMARY KEY,
          quiz TEXT NOT NULL,
          text TEXT,
          FOREIGN KEY(quiz) REFERENCES Quiz(idname)
        )'  
    );

    $questions = array(NULL,
                       "Best Landlord/Property",
                       "Best Off Campus Bar",
                       "Best Off Camps Restaurant",
                       "Best Workout Facility",
                       "Best Late Night Grubbery",
                       "Best Hangover Food",
                       "Best Sports Bar",
                       "Best Bar on State",
                       "Best Place to Cure Your Sweet Tooth",
                       "Favorite Pizza Joint",
                       "Best Drink Specials",
                       "Best Sandwich",
                       "Best Newcomer",
                       "Best Coffeehouse",
                       "Best Date Restaurant",
                       "Best Last Minute Booze Run",
                       "Best Clothing Store",
                       "Best Burger",
                       "Best Entertainment",
                       "Best Hair Salon",
                       "Best 21st Bar",
                       "Best Student Services",
                       "Best Smoke Shop",
                       "Best Trivia Night",
                       "Best Way To Get Around Campus",
                       );

    for ($i = 1; $i < count($questions); $i++) {
        $stmt = $dbh->prepare("INSERT INTO Questions(id, quiz, text) VALUES (?, ?, ?)");
        $stmt->execute(array($i, "student-choice-2014", $questions[$i]));
    }

    $dbh->exec(
        'CREATE TABLE Options (
          id INTEGER PRIMARY KEY,
          question_id INTEGER NOT NULL,
          text TEXT,
          photo_link TEXT,
          FOREIGN KEY(question_id) REFERENCES Questions(id)
        )'  
    );

    // Best Landlord/Property
    $options = array(NULL);
    $options[1] = array(
        array("JSM", ""),
        array("MPM", ""),
        array("Steve Brown", ""),
        array("J Michael", ""),
        array("Goldleaf Development", "")
    );

    // Best Off Campus Bar
    $options[2] = array(
        array("Essen House", ""),
        array("Great Dane", ""),
        array("Coliseum", ""),
        array("Brocach", ""),
        array("Echo Tap", ""),
        array("High Noon Saloon", "")
    );

    // Best Off Campus Restaurant
    $options[3] = array(
        array("Cooper's Tavern", ""),
        array("The Old Fashioned", ""),
        array("Barrique's", ""),
        array("The Melting Pot", ""),
        array("Flatop Grill", ""),
        array("PF Changs", ""),
        array("The Great Dane", "")
    );

    // Best Workout Facility
    $options[4] = array(
        array("Kaivalya Yoga", ""),
        array("CYC Fitness", ""),
        array("Anytime Fitness", ""),
        array("CYK Fitness", ""),
        array("Inner Fire Yoga", "")
    );

    // Best Late Night Grubbery
    $options[5] = array(
        array("Jimmy John's", ""),
        array("Asian Kitchen", ""),
        array("Fried n Fabulous", ""),
        array("Ian's", ""),
        array("Wings Over Madison", ""),
        array("Los Gemelos", ""),
        array("Taco Shop", ""),
        array("Qdoba", ""),
        array("Pita Pit", "")
    );

    // Best Hangover Food
    $options[6] = array(
        array("Qdoba", ""),
        array("Asian Kitchen", ""),
        array("Panera", ""),
        array("Jamba Juice", ""),
        array("JD's", ""),
        array("Taco Shop", ""),
        array("The Curve Restaurant", ""),
        array("Mickey's Dairybar", "")
    );

    // Best Sports Bar
    $options[7] = array(
        array("Lucky's Bar and Grille", ""),
        array("Buckinghams", ""),
        array("Johnny O's", ""),
        array("Buffalo Wild Wings", ""),
        array("Wandos", "")
    );

    // Best Bar on State
    $options[8] = array(
        array("Whiskey Jacks", ""),
        array("City Bar", ""),
        array("State Street Brats", ""),
        array("608", ""),
        array("Ivory Room Piano Bar", ""),
        array("Pauls Club", "")
    );

    // Best Place to Cure Your Sweet Tooth
    $options[9] = array(
        array("Gigi's Cupcakes", ""),
        array("Cold Stone Creamery", ""),
        array("Forever Yogurt", ""),
        array("Kilwins", ""),
        array("Madison Sweets", "")
    );

    // Favorite Pizza Joint
    $options[10] = array(
        array("Papa John's", ""),
        array("Falbos", ""),
        array("Pizza Di Roma", ""),
        array("Ian's", ""),
        array("Glass Nickel", ""),
        array("Rocky Roccoco's", ""),
        array("Pizza Pit", "")
    );

    // Best Drink Specials
    $options[11] = array(
        array("Whiskey Jacks", ""),
        array("Vintage", ""),
        array("Madhatters", ""),
        array("The Kollege Klub", ""),
        array("Lucky's Bar and Grille", ""),
        array("The Side Door", ""),
        array("Redrock Saloon", ""),
        array("Sotto", "")
    );

    // Best Sandwich
    $options[12] = array(
        array("Cheba Hut", ""),
        array("Erberts and Gerberts", ""),
        array("Jimmy John's", ""),
        array("Potbellys", ""),
        array("Millo's", ""),
        array("Silvermine Subs", "")
    );

    // Best Newcomer
    $options[13] = array(
        array("Steepery", ""),
        array("Wendy's on State", ""),
        array("Redrock Saloon", ""),
        array("608", ""),
        array("Basset Street Brunch Club", ""),
    );

    // Best Coffeehouse
    $options[14] = array(
        array("Expresso Royale", ""),
        array("Redamte", ""),
        array("Coffee Bytes", ""),
        array("Michaelangelo's", "")
    );

    // Best Date Restaurant
    $options[15] = array(
        array("Tutto Pasta", ""),
        array("Francesca's Al Lago", ""),
        array("Portabella", ""),
        array("Fresco Rooftop", ""),
        array("Crandalls", "")
    );

    // Best Last Minute Booze Run
    $options[16] = array(
        array("Regent Liquor", ""),
        array("Riley's", ""),
        array("Woodmans", ""),
        array("University Liquor", "")
    );

    // Best Clothing Store
    $options[17] = array(
        array("Urban Outfitters", ""),
        array("Pitaya", ""),
        array("Rethreads", ""),
        array("Fontana Sports", ""),
        array("Citrine", ""),
        array("Jazzman", "")
    );

    // Best Burger
    $options[18] = array(
        array("Nitty Gritty", ""),
        array("Dotty's Dumplings Dowry", ""),
        array("AJ Bombers", ""),
        array("Plaza", ""),
        array("Redrock $1 Wednesdays", "")
    );

    // Best Entertainment
    $options[19] = array(
        array("Comedy Club", ""),
        array("The Ivory Room", ""),
        array("The Orpheum", ""),
        array("The Majestic", "" ),
        array("The Overture Center", "")
    );

    // Best Hair Salon
    $options[20] = array(
        array("Aveda/VICI Institute", ""),
        array("Envy", ""),
        array("Negginz", ""),
        array("Alan Koa Salon", ""),
        array("Blow Dry Style Lounge", ""),
    );

    // Best 21st Bar
    $options[21] = array(
        array("Buck N Badger", ""),
        array("Nitty", ""),
        array("Wandos", ""),
        array("State Street Brats", ""),
        array("Redrock", "")
    );

    // Best Student Services
    $options[22] = array(
        array("Badger Coaches", ""),
        array("Badger Short Bus", ""),
        array("Student Leadership Program/ALPs", ""),
        array("ASM Student Print", ""),
        array("UHS", ""),
        array("Hillel", ""),
        array("Madison B-Cycle", "")
    );

    // Best Smoke Shop
    $options[23] = array(
        array("Knuckleheads", ""),
        array("pipefitters", ""),
        array("Smokes on state", ""),
        array("Sunshine Daydream", ""),
        array("Azara", "")
    );

    // Best Trivia Night
    $options[24] = array(
        array("Capital Tap House", ""),
        array("Chaser's", ""),
        array("Buckingham's", ""),
        array("Lucky's Bar and Grille", ""),
        array("Union South", "")
    );

    // Best Way To Get Around Campus
    $options[25] = array(
        array("Madison B-Cycle", ""),
        array("Community Car", ""),
        array("Green Cab", ""),
        array("Badger Cab", ""),
        array("Madison Metro Bus", "")
    );
    
    for ($i = 0; $i < count($options); $i++) {
        $option = $options[$i];
        for ($j = 0; $j < count($option); $j++) {
            $current_option = $option[$j];
            $stmt = $dbh->prepare("INSERT INTO Options(question_id, text, photo_link) VALUES (?, ?, ?)");
            // If no url in structure, just use an empty one to prevent crashing
            if (count($current_option) < 2) {
                $current_option[1] = "http://www.placecage.com/c/600/180";
            }
            $stmt->execute(array($i, $current_option[0], $current_option[1]));
        }
    }
    $dbh->exec(
        'CREATE TABLE Participants (
          id INTEGER PRIMARY KEY,
          email TEXT NOT NULL,
          quiz TEXT NOT NULL,
          FOREIGN KEY(quiz) REFERENCES Quiz(idname)
        )'
    );
    $dbh->exec(
        'CREATE TABLE Votes (
          id INTEGER PRIMARY KEY,
          participant_id INTEGER NOT NULL,
          option_id INTEGER NOT NULL,
          FOREIGN KEY(participant_id) REFERENCES Participants(id)
          FOREIGN KEY(option_id) REFERENCES Options(id)
        )'
    );

    $status = "Database created!\n";
} catch(Exception $e) {
    $status = $e->getMessage();
}
echo $status;
?>