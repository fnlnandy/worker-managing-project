<?php
include_once("../Models/Database/queries.php");

/**
 * Populates the affectation table in affectation_page.php
 * out of database data.
 */
function PopulateWorkerList()
{
    $result = ExecQuery("SELECT * FROM EMPLOYE ORDER BY NumEmp ASC;");
    $counter = 0;

    while($resultRow = $result->fetch_assoc()) {
        // $counter keeps track of the current id to pass as parameter to UpdateDataTracker,
        // we cannot just increment $counter each time in case of affectation deletion
        $counter = $resultRow['NumEmp'];

        // When we enter edit mode, we should know exactly which Row we want to edit,
        // hence why we always update gDataTracker
        echo "<tr class=\"workerRow\" onclick=\"UpdateDataTracker(".strval($counter).", true)\">";

        // For each column in the associative array i.e. for each field in a row in the table, we
        // add a new <td>
        foreach ($resultRow as $column) {
            echo "<td>".$column."</td>";
        }

        echo "</tr>";
    }
}
?>