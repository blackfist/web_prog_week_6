<?PHP 
    include_once("person_class.php");
    
    if(count($_GET) > 0) {
        // This is a GET request so we should pull the data and display it
        // but not update anything.
        $person = Person::find($_GET["id"]);
    }
    
    if(count($_POST) > 0) {
        // This is a POST request so we should get the user, change the data
        // and save it.
        $person = Person::find($_POST["id"]);
        $person->first_name = $_POST["first_name"];
        $person->last_name = $_POST["last_name"];
        $person->city = $_POST["city"];
        $person->state = $_POST["state"];
        $person->zip = $_POST["zip"];
        $person->email = $_POST["email"];
        $person->save();
    }
?>

<h1>Edit this person</h1>
<form action="edit_person.php" method="POST">
    <label for="first_name">First name</label><input type="text" name="first_name" value="<?php echo $person->first_name; ?>"/><br />
    <label for="last_name">Last name</label><input type="text" name="last_name" value="<?php echo $person->last_name; ?>"/><br />
    <label for="city">City</label><input type="text" name="city" value="<?php echo $person->city; ?>"/><br />
    <label for="state">State</label><input type="text" name="state" value="<?php echo $person->state; ?>"/><br />
    <label for="zip">Zip</label><input type="text" name="zip" value="<?php echo $person->zip; ?>"/><br />
    <label for="email">Email</label><input type="text" name="email" value="<?php echo $person->email; ?>"/><br />
    <input type="hidden" name="id" value="<?php echo $person->id; ?>"/>
    <input type="submit" name="Update"/>
</form>
<a href="people_app.php">Back</a>