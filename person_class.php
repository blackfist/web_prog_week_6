<?PHP 

    class Person {
        public $id = "";
        public $first_name = "";
        public $last_name = "";
        public $city = "";
        public $state = "";
        public $zip = "";
        public $email = "";
        
        public function save() {
            # Put in some code to create a database connection.
            try {
                $conn = new PDO( ... )
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            
            # Check if $this->id has anything in it.
            # If $this->id is empty then it must be a new person 
            # so use a SQL INSERT to add it to the database.
            # Otherwise use an UPDATE to change an existing record. The
            # queries below are not complete.
            
            if ($this->id == "") {
                $sql = "INSERT INTO people (list of column names) VALUES (:first_name, :city, etc) ";
            } else {
                $sql = "UPDATE people SET first_name = :first_name ...";
            }
            
            # Create a prepared statement using the $sql variable above. Bind
            # the column names to your class attributes.
            try {
                $prep = $conn->prepare($sql)
                # Bind values
                # execute the prepared statement
            } catch(PDOException $e) {
                    echo "query failed: " . $e->getMessage();
            }
        }
        
        public static function all() {
           # Connect to the database again
            $dsn = "mysql:dbname=orm";
            $username = "blackfist";

            try {
                $conn = new PDO($dsn, $username);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            
            # Set up your sql statement
            $sql = "SELECT * FROM people";
            
            try {
                # make a prepared statement and execute it
                $st = $conn->prepare($sql);
                $st->execute();
                
                # return the resulting rows
                return($prep->fetchAll());
            } catch(PDOException $e) {
                echo "Query failed: " . $e->getMessage();
            }
        }
        
        public static function find($id) {
            # Connect to database
            $dsn = "mysql:dbname=orm";
            $username = "blackfist";

            try {
                $conn = new PDO($dsn, $username);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            
            # write an sql query to get all the data from the
            # people database where the id field is equal to what was 
            # passed in.
            $sql = "SELECT * from people WHERE id = :id";
            
            try {
                # created a prepared statement and execute it
                $st = $conn->prepare($sql);
                $st->bindValue("id", $id);
                $st->execute();
                $results = $prep->fetch(PDO::FETCH_ASSOC);
                
                # Create a Person instance and fill it in with the stuff
                # you got back from your query above
                $tempPerson = new Person();
                $tempPerson->id = $results["id"];
                $tempPerson->first_name = $results["first_name"];
                $tempPerson->last_name = $results["last_name"];
                $tempPerson->city = $results["city"];
                $tempPerson->state = $results["state"];
                $tempPerson->zip = $results["zip"];
                $tempPerson->email = $results["email"];
                return($tempPerson);
            } catch(PDOException $e) {
                echo "Query failed: " . $e->getMessage();
            }
        }
    }
?>