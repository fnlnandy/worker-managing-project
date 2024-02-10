<?php
DEFINE("gHostName", "localhost");           //
DEFINE("gUserName", "root");                // Default options for wamp
DEFINE("gPassword", "");                    //

DEFINE("gDatabaseName", "dbGestionTravail");// To avoid hard-coding

$gSqlConnection = new mysqli(gHostName, gUserName, gPassword);

class XMLHttpRequest {
    /**
     * Decodes JSON data sent via AJAX
     */
    public static function DecodeJson(): array
    {
        $returnValue = json_decode(file_get_contents("php://input"), true);
        return $returnValue;
    }
}

class SQLQuery {
    /**
     * Checks if there was any error while connecting
     * to the MySql database
     */
    public static function CheckConnection() : void {
        global $gSqlConnection;

        if (!$gSqlConnection) {
            die("Error opening database, quitting.");
        }
    }

    /**
     * Specify that we want to use the correct database,
     * for some reason it must be called before executing
     * a query
     */
    public static function ChooseDatabase()
    {
        global $gSqlConnection;
        $result = $gSqlConnection->query("USE ".gDatabaseName.";");

        if (!$result) {
            die("Error using ".gDatabaseName.", quitting.");
        }
    }

    /**
     * Initalize the database and add every
     * needed table
     */
    public static function CreateDatabase()
    {
        global $gSqlConnection;

        $queries = array(
            "CREATE DATABASE IF NOT EXISTS ".gDatabaseName.";",
            "USE ".gDatabaseName.";",
            "CREATE TABLE IF NOT EXISTS LIEU(
                IDLieu VARCHAR(10) PRIMARY KEY,
                Design CHAR(30),
                Province CHAR(30)
                );",
            "CREATE TABLE IF NOT EXISTS EMPLOYE(
                NumEmp VARCHAR(10) PRIMARY KEY,
                Civilite CHAR(4),
                Nom CHAR(30),
                Prenom CHAR(40),
                Mail CHAR(254),
                Poste CHAR(50),
                Lieu CHAR(70)
            );",
            "CREATE TABLE IF NOT EXISTS AFFECTER(
                NumAffect VARCHAR(10),
                NumEmp VARCHAR(10),
                AncienLieu CHAR(30),
                NouveauLieu CHAR(30),
                DateAffect DATE,
                DatePriseService DATE,
                PRIMARY KEY(NumAffect, NumEmp)
            );",
        );

        // We execute each element from $queries and simultaneously
        // check for any possible error
        foreach ($queries as $query) {
            $result = $gSqlConnection->query($query);

            if (!$result) {
                die("Error executing query:'".$query."', quitting");
            }
        }
    }
    /**
     * Shortcut to avoid referencing $gSqlConnection and choosing
     * out current database everytime we want to execute a single
     * query
     */
    public static function ExecQuery(string $query): mysqli_result|bool
    {
        global $gSqlConnection;

        SQLQuery::ChooseDatabase();
        $result = $gSqlConnection->query($query);

        if (!$result) {
            die("Error executing query:'".$query."', quitting.");
        }

        return $result;
    }

    /**
     * Instead of using $var->prepare which requires you to reference
     * $gSqlConnection, and isn't really modular when you want to re-order
     * arguments in it, this function replaces arguments in a string with
     * $queryArgs which are arguments with variable number
     * 
     * Expected format is : INSTR [1] [2]...;
     */
    public static function ExecPreparedQuery(string $queryToBind, ... $queryArgs): mysqli_result|bool
    {
        // Expected starting id of the bindable parameters
        $idCounter = 1;

        foreach ($queryArgs as $arg) {
            $queryToBind = str_replace("[".strval($idCounter)."]", 
                        strval($arg), 
                        $queryToBind);
            $idCounter++;
        }

        return SQLQuery::ExecQuery($queryToBind);
    }
    /**
     * 
     */
    public static function RemoveFromTable()
    {

    }
}
?>