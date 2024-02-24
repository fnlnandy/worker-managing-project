<!DOCTYPE html>
<html>
    <head>
        <title>Page des lieux</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Page des lieux">
        <link rel="icon" href="" type="image/x-icon">
        <link rel="stylesheet" href="Stylesheets/main.css">
    </head>
    <body>
    <script src="../Control/Location/handler.js"></script>
        <nav class="topNavigationBar"><a href="../index.php">Menu principal</a></nav>

        <!-- Table that will contain informations about every affectation -->
        <div class="tableListingAreaContainer">
            <table border="1" class="tableListingArea">
                <tr class="locationHeaderRow">
                    <th>ID Lieu</th>
                    <th>Design</th>
                    <th>Province</th>
                </tr>

                <?php
                    include_once("../Models/table_helpers.php");
                    TableHelper::PopulateTableElementWithDatabseData("LIEU", "IDLieu", "locationRow");
                ?>
            </table>
        </div>

        <div class="centerElementsFlex">
            <span class="actionButtonsContainer">
                <button onclick="AddLocation()">Ajouter</button>
                <button onclick="EditLocation()">Modifier</button>
                <button onclick="RemoveLocation()">Supprimer</button>
            </span>
        </div>

        <!-- Form that will be shown when adding or editing an entry -->
        <form onsubmit="SubmitForm()" method="post" id="locationForm" hidden>
                <label>Design: <input id="formLocationDesign" name="formLocationDesign" type="text" required>        <br></label>
                <label>Province: <input id="formLocationProvince" name="formLocationProvince" type="text" required>       <br></label>
                <input type="submit" value="Confirmer">
                <input type="reset" value="Réinitaliser">
        </form>
    </body>
</html>