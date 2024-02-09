<!DOCTYPE html>
<html>
    <head>
        <title>Menu principal</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="Stylesheets/main.css">
    </head>
    <body>
    <script src="../Control/Location/handler.js"></script>
        <a href="../index.php">Menu principal</a>

        <label>Id actuel:<input id="currentNumLocationDisplayer" type="number" readonly value="0"></label>
        <!-- Table that will contain informations about every affectation -->
        <table border="1">
            <tr class="locationHeaderRow">
                <th>ID Lieu</th>
                <th>Design</th>
                <th>Province</th>
            </tr>

            <?php
            include_once("../Control/Location/helper.php");
            PopulateLocationList(); // Should always be last
            ?>
        </table>

        <button onclick="AddLocation()">Ajouter</button>
        <button onclick="EditLocation()">Modifier</button>
        <button onclick="RemoveLocation()">Supprimer</button>

        <!-- Form that will be shown when adding or editing an entry -->
        <form onsubmit="SubmitForm()" method="post" id="locationForm" hidden>
                <label>Design: <input id="formLocationDesign" name="formLocationDesign" type="text" required>        <br></label>
                <label>Province: <input id="formLocationProvince" name="formLocationProvince" type="text" required>       <br></label>
                <input type="submit" value="Confirmer">
                <input type="reset" value="Réinitaliser">
        </form>
    </body>
</html>