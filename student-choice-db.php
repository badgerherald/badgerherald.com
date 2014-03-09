<?php
try {
    $dbh = new PDO("mysql:host=localhost;dbname=student_choice_2014", "will", "will");
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    $dbh->exec('DROP TABLE IF EXISTS Votes');
    $dbh->exec('DROP TABLE IF EXISTS Participants');
    $dbh->exec('DROP TABLE IF EXISTS Options');
    $dbh->exec('DROP TABLE IF EXISTS Questions');
    $dbh->exec('DROP TABLE IF EXISTS Quiz');

    $dbh->exec(
        'CREATE TABLE Quiz (
          idname VARCHAR(250) PRIMARY KEY,
          name TEXT
        )'
    );
    $dbh->exec('INSERT INTO Quiz(idname, name) VALUES ("student-choice-2014", "Student Choice 2014 Nominations")');

    $dbh->exec(
        'CREATE TABLE Questions (
          id INTEGER PRIMARY KEY,
          quiz VARCHAR(250) NOT NULL,
          text TEXT,
          photo_url TEXT,
          FOREIGN KEY(quiz) REFERENCES Quiz(idname)
        )'
    );



    $img_dir = "http://localhost/bhrld/wordpress/wp-content/themes/exa/img/student-choice/2014/";

    $questions = array(NULL,
                       array("Best Landlord/Property", $img_dir."landlord.jpg"),
                       array("Best Off Campus Bar", $img_dir."best-off-campus-bar.jpg"),
                       array("Best Off Campus Restaurant", $img_dir."best-off-campus-restaurant.jpg"),
                       array("Best Fitness", $img_dir."best-fitness.jpg"),
                       array("Best Late Night Night Food",$img_dir."best-late-night-food.jpg"),
                       array("Best Hangover Food", $img_dir."best-hangover-food.jpg"),
                       array("Best Sports Bar", $img_dir."best-sports-bar.jpg"),
                       array("Best Bar on State", $img_dir."best-bar-on-state.jpg"),
                       array("Best Place to Cure Your Sweet Tooth", $img_dir."best-place-to-cure-sweet-tooth.jpg"),
                       array("Favorite Pizza Joint", $img_dir."favorite-pizza-joint.jpg"),
                       array("Best Drink Specials", $img_dir."best-drink-specials.jpg"),
                       array("Best Sandwich", $img_dir."best-sandwich.jpg"),
                       array("Best Newcomer", $img_dir."best-newcomer.jpg"),
                       array("Best Coffeehouse", $img_dir."best-coffeehouse.jpg"),
                       array("Best Date Restaurant", $img_dir."best-date-restuarant.jpg"),
                       array("Best Last Minute Booze Run", $img_dir."best-liquor-store.jpg"),
                       array("Best Clothing Store", $img_dir."best-clothing-store.jpg"),
                       array("Best Burger", $img_dir."best-burger.jpg"),
                       array("Best Entertainment", $img_dir."best-entertainment.jpg"),
                       array("Best Hair Salon", $img_dir."best-hair-salon.jpg"),
                       array("Best 21st Bar", $img_dir."best-21st-bar.jpg"),
                       array("Best Student Services", $img_dir."best-student-services.jpg"),
                       array("Best Smoke Shop", $img_dir."best-smoke-shop.jpg"),
                       array("Best Trivia Night", $img_dir."best-trivia-night.jpg"),
                       array("Best Way To Get Around Campus", $img_dir."best-transportation.jpg")
                       );

    for ($i = 1; $i < count($questions); $i++) {
        $current_question = $questions[$i];
        $stmt = $dbh->prepare("INSERT INTO Questions(id, quiz, text, photo_url) VALUES (?, ?, ?, ?)");
        $stmt->execute(array($i, "student-choice-2014", $current_question[0], $current_question[1]));
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
        array("JSM", $img_dir."jsm.jpg"),
        array("MPM", $img_dir."mpm.jpg"),
        array("Steve Brown", $img_dir."steve-brown.jpg"),
        array("Tallard", $img_dir."tallard.jpg"),
        array("Goldleaf Development", $img_dir."goldleaf.jpg")
    );

    // Best Off Campus Bar
    $options[2] = array(
        array("Essen Haus", $img_dir."essen-haus.jpg"),
        array("Great Dane", $img_dir."the-great-dane.jpg"),
        array("Coliseum", $img_dir."coliseum.jpg"),
        array("Brocach", $img_dir."brocach.jpg"),
        array("Echo Tap", $img_dir."echo-tap.jpg"),
        array("High Noon Saloon", $img_dir."high-noon-saloon.jpg")
    );

    // Best Off Campus Restaurant
    $options[3] = array(
        array("Cooper's Tavern", $img_dir."coopers-tavern.jpg"),
        array("The Old Fashioned", $img_dir."old-fashioned.jpg"),
        array("The Melting Pot", $img_dir."melting-pot.jpg"),
        array("FlatTop Grill", $img_dir."flat-top.jpg"),
        array("PF Changs", $img_dir."pf-changs.jpg"),
        array("The Great Dane", $img_dir."the-great-dane.jpg")
    );

    // Best Workout Facility
    $options[4] = array(
        array("Kaivalya Yoga", $img_dir."kaivalya-yoga.jpg"),
        array("CYC Fitness", $img_dir."cyc-fitness.jpg"),
        array("Anytime Fitness", $img_dir."anytime-fitness.jpg"),
        array("Inner Fire Yoga", $img_dir."inner-fire-yoga.jpg")
    );

    // Best Late Night Grubbery
    $options[5] = array(
        array("Jimmy John's", $img_dir."jimmy-johns.jpg"),
        array("Asian Kitchen", $img_dir."asian-kitchen.jpg"),
        array("Fried n Fabulous", $img_dir."fried-fab.jpg"),
        array("Ian's", $img_dir."ians.jpg"),
        array("Wings Over Madison", $img_dir."wings-over.jpg"),
        array("Los Gemelos", $img_dir."los-gemelos.jpg"),
        array("Taco Shop", $img_dir."taco-shop.jpg"),
        array("Qdoba", $img_dir."qdoba.jpg"),
        array("Pita Pit", $img_dir."pita-pit.jpg")
    );

    // Best Hangover Food
    $options[6] = array(
        array("Einstein's Bagels", $img_dir."einsteins.jpg"),
        array("Gordon's Commons", $img_dir."gordons.jpg"),
        array("Greenbush Bakery", $img_dir."greenbush.jpg"),
        array("Jamba Juice", $img_dir."jamba.jpg"),
        array("Bassett Street Brunch Club", $img_dir."bassett-brunch.jpg"),
        array("The Sunroom", $img_dir."sunroom.jpg"),
        array("Bagel's Forever", $img_dir."bagels.jpg"),
        array("Mickies Dairy Bar", $img_dir."mickies.jpg")
    );

    // Best Sports Bar
    $options[7] = array(
        array("Lucky's Bar and Grille", $img_dir."luckys-bar-grill.jpg"),
        array("Buckinghams", $img_dir."buckinghams.jpg"),
        array("Johnny O's", $img_dir."johnny-o.jpg"),
        array("Buffalo Wild Wings", $img_dir."buffalo-wild-wings.jpg"),
        array("Wandos", $img_dir."wandos.jpg"),
        array("Jordan's Big Ten Pub", $img_dir."jordans-pub.jpg")
    );

    // Best Bar on State
    $options[8] = array(
        array("Whiskey Jacks", $img_dir."whiskey-jacks.jpg"),
        array("City Bar", $img_dir."city-bar.jpg"),
        array("State Street Brats", $img_dir."state-street-brats.jpg"),
        array("608", $img_dir."608.jpg"),
        array("Ivory Room Piano Bar", $img_dir."ivory-room.jpg"),
        array("Pauls Club", $img_dir."pauls-club.jpg"),
        array("Mondays", $img_dir."mondays.jpg"),
        array("The Tiki Shack", $img_dir."tiki-shack.jpg"),
        array("Diegos", $img_dir."diegos.jpg")
    );

    // Best Place to Cure Your Sweet Tooth
    $options[9] = array(
        array("Gigi's Cupcakes", $img_dir."gigis-cupcakes.jpg"),
        array("Forever Yogurt", $img_dir."forever-yogurt.jpg"),
        array("Kilwins", $img_dir."kilwins.jpg"),
        array("Madison Sweets", $img_dir."madison-sweets.jpg"),
        array("Greenbush", $img_dir."greenbush.jpg"),
        array("The Chocolate Shoppe", $img_dir."chocolate-shop.jpg")
    );

    // Favorite Pizza Joint
    $options[10] = array(
        array("Papa John's", $img_dir."papa-johns.jpg"),
        array("Falbos", $img_dir."falbo.jpg"),
        array("Pizza Di Roma", $img_dir."pizza-di-roma.jpg"),
        array("Ian's", $img_dir."ians.jpg"),
        array("Glass Nickel", $img_dir."glass-nickel.jpg"),
        array("Rocky Roccoco's", $img_dir."rocky-rococo.jpg"),
        array("Pizza Pit", $img_dir."pizza-pit.jpg"),
        array("Toppers", $img_dir."toppers.jpg"),
        array("Dominos", $img_dir."dominos.jpg")
    );

    // Best Drink Specials
    $options[11] = array(
        array("Whiskey Jacks", $img_dir."whiskey-jacks.jpg"),
        array("Vintage", $img_dir."vintage.jpg"),
        array("Madhatters", $img_dir."madhatter.jpg"),
        array("The Kollege Klub", $img_dir."the-kk.jpg"),
        array("Lucky's Bar and Grille", $img_dir."luckys-bar-grill.jpg"),
        array("The Side Door", $img_dir."the-side-door.jpg"),
        array("Redrock Saloon", $img_dir."redrock.jpg"),
        array("Sotto", $img_dir."sotto.jpg"),
        array("The Plaza", $img_dir."plaza.jpg")
    );

    // Best Sandwich
    $options[12] = array(
        array("Cheba Hut", $img_dir."cheba-hut.jpg"),
        array("Erberts and Gerberts", $img_dir."erberts-gerberts.jpg"),
        array("Jimmy John's", $img_dir."jimmy-johns.jpg"),
        array("Potbellys", $img_dir."potbelly.jpg"),
        array("Millo's", $img_dir."milios.jpg"),
        array("Silvermine Subs", $img_dir."silver-mine-subs.jpg")
    );

    // Best Newcomer
    $options[13] = array(
        array("Steepery", $img_dir."steepery.jpg"),
        array("Wendy's on State", $img_dir."wendys.jpg"),
        array("Redrock Saloon", $img_dir."redrock.jpg"),
        array("608", $img_dir."608.jpg"),
        array("Basset Street Brunch Club", $img_dir."basset-street-brunch-club.jpg"),
        array("Lyft", $img_dir."lyft.png")
    );

    // Best Coffeehouse
    $options[14] = array(
        array("Espresso Royale", $img_dir."espresso-royale.jpg"),
        array("Redamte", $img_dir."redamte-coffee.jpg"),
        array("Coffee Bytes", $img_dir."coffee-bytes.jpg"),
        array("Michaelangelo's", $img_dir."michelangelos.jpg"),
        array("Barrique's", $img_dir."bariques.jpg"),
        array("Steep and Brew", $img_dir."steep-brew.jpg"),
        array("Indie Coffee", $img_dir."indie-coffee.jpg"),
        array("Fair Trade", $img_dir."fair-trade-coffee.jpg"),
        array("Peets", $img_dir."peets-coffee.jpg")
    );

    // Best Date Restaurant
    $options[15] = array(
        array("Tutto Pasta", $img_dir."tutto-pasta.jpg"),
        array("Francesca's Al Lago", $img_dir."francescas-al-lago.jpg"),
        array("Portabella", $img_dir."porta-bella.jpg"),
        array("Fresco Rooftop", $img_dir."fresco-rooftop.jpg"),
        array("Crandalls", $img_dir."crandalls.jpg"),
        array("Samba", $img_dir."samba.jpg"),
        array("Graze", $img_dir."graze.jpg")
    );

    // Best Last Minute Booze Run
    $options[16] = array(
        array("Regent Liquor", $img_dir."regent-liquor.jpg"),
        array("Riley's", $img_dir."rileys.jpg"),
        array("Woodmans", $img_dir."woodmans.jpg"),
        array("University Liquor", $img_dir."university-liquor.jpg"),
        array("Badger Liquor", $img_dir."badger-liquor.jpg")
    );

    // Best Clothing Store
    $options[17] = array(
        array("Urban Outfitters", $img_dir."urban-outfitters.jpg"),
        array("Pitaya", $img_dir."pitaya.jpg"),
        array("Rethreads", $img_dir."rethreads.jpg"),
        array("Fontana Sports", $img_dir."fontana-sports.jpg"),
        array("Citrine", $img_dir."citrine.jpg"),
        array("Jazzman", $img_dir."jazzman.jpg"),
        array("Gap", $img_dir."gap.jpg"),
        array("American Apparel", $img_dir."american-apparel.jpg"),
        array("Bop", $img_dir."bop.jpg")
    );

    // Best Burger
    $options[18] = array(
        array("Nitty Gritty", $img_dir."nitty-gritty.jpg"),
        array("Dotty's Dumplings Dowry", $img_dir."dotty-dumpling-dowry.jpg"),
        array("AJ Bombers", $img_dir."aj-bombers.jpg"),
        array("Plaza", $img_dir."plaza.jpg"),
        array("Redrock $1 Wednesdays", $img_dir."redrock.jpg"),
        array("Five Guys", $img_dir."five-guys.jpg"),
        array("The Sett", $img_dir."union-south.jpg"),
        array("Jordan's Big Ten Pub", $img_dir."jordans-big-10.jpg"),
        array("Wendy's", $img_dir."wendys.jpg")
    );

    // Best Entertainment
    $options[19] = array(
        array("Comedy Club", $img_dir."comedy-club.jpg"),
        array("The Ivory Room", $img_dir."ivory-room.jpg"),
        array("The Orpheum", $img_dir."orpheum.jpg"),
        array("The Majestic", $img_dir."majestic.jpg" ),
        array("The Overture Center", $img_dir."overture-center.jpg")
    );

    // Best Hair Salon
    $options[20] = array(
        array("Aveda/VICI Institute", $img_dir."vc.jpg"),
        array("Hachi", $img_dir."hachi.jpg"),
        array("Nogginz", $img_dir."nogginz.jpg"),
        array("Alan Koa Salon", $img_dir."alan-koa.jpg"),
        array("Hair Forum", $img_dir."hair-forum.jpg"),
    );

    // Best 21st Bar
    $options[21] = array(
        array("The KK", $img_dir."the-kk.jpg"),
        array("Nitty Gritty", $img_dir."nitty-gritty.jpg"),
        array("Wandos", $img_dir."wandos.jpg"),
        array("State Street Brats", $img_dir."state-street-brats.jpg"),
        array("Redrock", $img_dir."redrock.jpg"),
        array("Madhatters", $img_dir."madhatter.jpg")
    );

    // Best Student Services
    $options[22] = array(
        array("Badger Coaches", $img_dir."badger-coaches.jpg"),
        array("Badger Short Bus", $img_dir."badger-short-bus.jpg"),
        array("Student Leadership Program/ALPs", $img_dir."student-leadership.jpg"),
        array("ASM Student Print", $img_dir."student-print.jpg"),
        array("UHS", $img_dir."uhs.jpg"),
        array("Hillel", $img_dir."hillel.jpg"),
        array("Madison B-Cycle", $img_dir."madison-b-cycle.jpg")
    );

    // Best Smoke Shop
    $options[23] = array(
        array("Knuckleheads", $img_dir."knuckleheads.jpg"),
        array("Pipefitters", $img_dir."pipefitter.jpg"),
        array("Smokes on State", $img_dir."smokes-on-state.jpg"),
        array("Sunshine Daydream", $img_dir."sunshine-daydream.jpg"),
        array("Azara", $img_dir."azara.jpg")
    );

    // Best Trivia Night
    $options[24] = array(
        array("Capital Tap Haus Tavern", $img_dir."capital-tap-haus.jpg"),
        array("Chaser's", $img_dir."chasers.jpg"),
        array("Buckingham's", $img_dir."buckinghams.jpg"),
        array("Lucky's Bar and Grille", $img_dir."luckys-bar-grill.jpg"),
        array("Union South", $img_dir."union-south.jpg"),
        array("City Bar", $img_dir."city-bar.jpg")
    );

    // Best Way To Get Around Campus
    $options[25] = array(
        array("Madison B-Cycle", $img_dir."madison-b-cycle.jpg"),
        array("Community Car", $img_dir."community-car.png"),
        array("Green Cab", $img_dir."green-cab-logo.png"),
        array("Badger Cab", $img_dir."badger-cab.jpg"),
        array("Madison Metro Bus", $img_dir."madison-metro.png"),
        array("Lyft", $img_dir."lyft.png")
        ,
        array("Union Cab", $img_dir."union-cab.png")
    );

    $index_stmt = $dbh->prepare("SELECT MAX(id) FROM Options");
    $index_stmt->execute(array());
    $option_index = $index_stmt->fetchAll()[0][0] + 1;
    for ($i = 0; $i < count($options); $i++) {
        $option = $options[$i];
        for ($j = 0; $j < count($option); $j++) {
            $current_option = $option[$j];
            $stmt = $dbh->prepare("INSERT INTO Options(id, question_id, text, photo_link) VALUES (?, ?, ?, ?)");
            // If no url in structure, just use an empty one to prevent crashing
            if (count($current_option) < 2) {
                $current_option[1] = "";
            }
            $stmt->execute(array($option_index, $i, $current_option[0], $current_option[1]));
            $option_index++;
        }
    }
    $dbh->exec(
        'CREATE TABLE Participants (
          id INTEGER PRIMARY KEY,
          email TEXT NOT NULL,
          quiz VARCHAR(250) NOT NULL,
          FOREIGN KEY(quiz) REFERENCES Quiz(idname)
        )'
    );
    $dbh->exec(
        'CREATE TABLE Votes (
          id INTEGER PRIMARY KEY,
          participant_id INTEGER NOT NULL,
          option_id INTEGER NOT NULL,
          FOREIGN KEY(participant_id) REFERENCES Participants(id),
          FOREIGN KEY(option_id) REFERENCES Options(id)
        )'
    );

    $status = "Database created!\n";
} catch(Exception $e) {
    $status = $e->getMessage();
}
echo ($status . "\n");
?>