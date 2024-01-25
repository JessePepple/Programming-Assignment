<?php
$pdo = new PDO('mysql:dbname=electronics;host=mysql', 'student', 'student');
session_start();

$navCategories = findAll($pdo, 'categories');

/**
 * Gets all record in the specified table
 */
function findAll($pdo, $table, $orderBy = 'id', $order = 'ASC')
{
   $stmt = $pdo->prepare("SELECT * FROM $table ORDER BY $orderBy $order");

   $stmt->execute();

   return $stmt->fetchAll();
}

/**
 * Gets all records that match a where clause
 */
function find($pdo, $table, $field, $value = null, $orderBy = 'id', $order = 'DESC')
{

    // if our field is an array it means we're searching for multiple conditions
    if(is_array($field)) {
        $sql = "SELECT * FROM $table WHERE ";
        $i = 0;

        // if the first element is an array, then we are making use of custom comparison symbols
        if(is_array($field[0])) {

            $keyValues = [];

            foreach($field as $value) {
                $keyValues[$value[0]] = $value[2];

                if($i !== 0) $sql .= ' AND ';
                $sql .= "$value[0] $value[1] :$value[0]";
    
                $i++;
            }

            $sql .= " ORDER BY $orderBy $order";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($keyValues);

        } else {
            foreach($field as $key => $value) {
                if($i !== 0) $sql .= ' AND ';
                $sql .= "$key = :$key";
    
                $i++;
            }

            $sql .= " ORDER BY $orderBy $order";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($field);
        }

    }
    else
    {
        $stmt = $pdo->prepare("SELECT * FROM $table WHERE $field = :value ORDER BY $orderBy $order");

        $criteria = ['value' => $value];

        $stmt->execute($criteria);
    }
   

    return $stmt->fetchAll();
}

/**
 * Our homepage product listing
 */
function homeListing($pdo)
{
    $stmt = $pdo->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 10");

    $stmt->execute();

    return $stmt->fetchAll();
}

/**
 * Returns the answers for a question
 */
function getAnswers($questionId, $pdo)
{
    $sql = "SELECT
    users.email,
    answers.*
    FROM answers INNER JOIN users ON answers.answered_by = users.id WHERE
    answers.question_id = :value";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['value' => $questionId]);

    $answers = $stmt->fetchAll();

    return $answers;
}

/**
 * Inserts data into a table
 * @param $pdo
 * @param $table
 * @param $data array of key to value pairs
 */
function insert($pdo, $table, $data)
{
    $keys = array_keys($data);
    $implodedString = implode(',', $keys);
    $values = implode(', :', $keys);

    $sql = "INSERT INTO $table ($implodedString) VALUES(:$values)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
}

/**
 * Updates data in a specified table
 */
function update($pdo, $table, $data, $primaryKey)
{

    $sql = "UPDATE $table SET ";

    $parameters = [];

    foreach($data as $key => $value) {
        $parameters[] = "$key = :$key";
    }
    $sql .= implode(', ', $parameters);
    $sql .= " WHERE $primaryKey = :primaryKey";
    $data['primaryKey'] = $data[$primaryKey];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
}

/**
 * Deletes the data in a table by the id
 */
function delete($pdo, $table, $value, $column = 'id') {
$stmt = $pdo->prepare("delete from $table where $column = :value");
$stmt->execute(['value' => $value]);
}

/**
 * counts all rows in a table
 */
function rowCount($pdo, $table, $field = null, $value = null)
{
    $sql = "SELECT COUNT(*) as count from $table";

    if($field && $value)
    {
        $sql .= " WHERE $field = :$field";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$field => $value]);
    }

    else
    {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }

    return $stmt->fetch()['count'];
}

/** 
 * flashes a message to our session
 * we can also use this to normally set our sessions
 */
function flash($type, $message, $array = false) {
    if($array) {
        $_SESSION[$type][] = $message;
    } else {
        $_SESSION[$type] = $message;
    } 
}

/**
 * Makes sure the specified fields are present in the form request and they are not empty
 */
function formRequire(...$fields)
{
    foreach ($fields as $value) {
        if(empty($_POST[$value])) {
            flash('validation',"$value field is required!", true);
        }
    }
}

/**
 * Checks if the request has this field value set
 * returns null if field name doesn't exist in either GET or POST
 */
function oldValue($name, $default = null)
{
    if(isset($_POST[$name])) {
        return $_POST[$name];
    } else if (isset($_GET[$name])) {
        return $_GET[$name];
    }

    return $default;
}
/**
 * Determines if current user is logged in
 */
function isLogged() {
    return (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true);
}

/**
 * Checks if there are validation errors
 */
function isValid()
{
    return (!isset($_SESSION['validation']));
}

/**
 * Checks if a form has been submitted
 */
function isSubmitted()
{
    return ($_SERVER['REQUEST_METHOD'] == 'POST');
}

/**
 * Checks if current user is an admin/staff
 */
function isAdmin()
{
    return (isset($_SESSION['rank']) && $_SESSION['rank'] == 1);
}
/**
 * Redirects user to the specified page
 */
function redirect($page) {
    header("Location: $page");
    exit;
}

/**
 * Redirects user to the previous page
 */
function back() {
    return redirect($_SERVER['HTTP_REFERER']);
}

/**
 * Redirects user back if they are not admin
 */
function adminLock() {
    if(!isAdmin()) {
        flash('error', 'You are not authorized!');
        return back();
    }
}

/**
 * Redirects user back if they are not logged in
 */
function userLock() {
    if(!isLogged()) {
        flash('error', 'You are not authorized!');
        return back();
    }
}

/**
 * Returns a readable date
 */
function humanDate($date) {
    $date = date_create($date);

    return date_format($date, "jS F Y");
}