<?PHP 
    include_once("person_class.php");

    if(count($_POST) > 0) {
        $newkid = new Person();
        $newkid->first_name = $_POST["first_name"];
        $newkid->last_name = $_POST["last_name"];
        $newkid->city = $_POST["city"];
        $newkid->state = $_POST["state"];
        $newkid->zip = $_POST["zip"];
        $newkid->email = $_POST["email"];
        $newkid->save();
    }
    
    $people = Person::all();
?>
<h1>Look at all my people</h1>
<table border="1">
    <thead>
        <tr><th>First</th>
            <th>Last</th>
            <th>City</th>
            <th>State</th>
            <th>Zip</th>
            <th>Email</th>
            <th>Action</th></tr>
    </thead>
    <tbody>
        <?PHP 
            foreach($people as $person) {
                echo "<tr>\n";
                echo "\t<td>{$person[1]}</td>\n";
                echo "\t<td>{$person[2]}</td>\n";
                echo "\t<td>{$person[3]}</td>\n";
                echo "\t<td>{$person[4]}</td>\n";
                echo "\t<td>{$person[5]}</td>\n";
                echo "\t<td>{$person[6]}</td>\n";
                echo "\t<td><a href=\"edit_person.php?id={$person[0]}\">Edit</a></td>\n";
                echo "</tr>";
            }
        ?>
    </tbody>

</table>

<h1>Add another person</h1>
<form action="people_app.php" method="POST">
    <label for="first_name">First name</label><input type="text" name="first_name"/><br />
    <label for="last_name">Last name</label><input type="text" name="last_name"/><br />
    <label for="city">City</label><input type="text" name="city"/><br />
    <label for="state">State</label><input type="text" name="state"/><br />
    <label for="zip">Zip</label><input type="text" name="zip"/><br />
    <label for="email">Email</label><input type="text" name="email"/><br />
    <input type="submit" name="submit"/>
    
</form>