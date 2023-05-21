<form action="/form" method="post">
    <label for="name">Name</label>
    <input id="name" name="name" type="text" />
    <button type="submit">Submit</button>
</form>

<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        echo "Hello " . $_POST['name'];
    }
?>