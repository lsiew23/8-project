<?php

/*************************************************************************************************
 * permitDetail.php
 *
 * Content page to display the detail form for a single application. This page is expected to be
 * contained within index.php.
 *************************************************************************************************/

$ordId = '';
$date = '';
$name = '';
$email = '';
$pizzatype = '';
$quantity = '';

$conn = get_database_connection();

if (isset($id))
{
    // Step 1: Load the customer and application records
    $sql = <<<SQL
    SELECT *
      FROM orders
     WHERE ord_id = $id
    SQL;

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    $appId = $row['ord_id'];
    $date = $row['ord_date'];
    $name = $row['ord_name'];
    $email = $row['ord_email'];
    $pizzatype = $row['ord_type'];
    $quantity = $row['ord_quantity'];

}

?>

<!-- <script>
    function deleteApplication(id) {
        if (confirm('Are you sure you want to delete this application?')) {
            location.href = 'delete.php?id=' + id;
        }
    }
</script> -->

<form action="hhssave.php" method="POST">
    <input type="hidden" name="ordId" value="<?php echo $ordId; ?>" />
    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control" name="date" value="<?php echo $date; ?>">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Pizza Type</label>
        <input type="text" class="form-control" name="type" value="<?php echo $type; ?>">
    </div>
    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="int" class="form-control" name="quantity" value="<?php echo $quantity; ?>">
    </div>
<?php

$conn->close();

?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Save Order</button>
<?php

// if (isset($id))
// {
//     echo '<a href="javascript:deleteApplication(' . $id . ')" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>';
// }

?>
    <a href="index.php?content=order" class="btn btn-secondary" role="button">Cancel</a>
</form>