<!-- DATA STORING TABLE TO ACCESS IN JS -->
<table class="clent-side-database" id="location-id-name-relation">
    <?php 
        include_once("../Models/queries.php");

        $query = SQLQuery::ExecQuery("SELECT IDLieu, Design, Province FROM LIEU ORDER BY LENGTH(IDLieu) ASC, IDLieu ASC;");

        if (is_null($query))
            return;

        while ($row = $query->fetch_assoc()) {
            echo "<tr>";

            echo "<td>".$row['IDLieu']."</td>";
            echo "<td>{$row['Design']} ({$row['Province']})</td>";

            echo "</tr>";
        }
    ?>
</table>