<?php

/*************************************************************************************************
 * permitList.php
 *
 * Content page to display a list of applications. This page is expected to be contained within
 * index.php.
 *************************************************************************************************/

?>

<script>
    function editApplication(id) {
        location.href = 'index.php?content=detail&id=' + id;
    }
</script>

<table class='table table-bordered table-hover'>
    <thead>
        <tr class="table-dark">
            <th>#</th>
            <th>Date</th>
            <th>Name</th>
            <th>Email</th>
            <th>Pizza type</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">

    <?php

    $conn = get_database_connection();

    // Build the SELECT statement
    $sql = <<<SQL
    SELECT ord_id, ord_date, ord_name, ord_email, ord_type, ord_slice_quantity
           GROUP_CONCAT(CONCAT(par_name, ' - ', pka_name) ORDER BY pka_name SEPARATOR '<br>') as field_list
      FROM orders
     ORDER BY app_date, ord_name, ord_id
    SQL;

    // Execute the query and save the results
    $result = $conn->query($sql);

    $empty = true;

    // Iterate over each row in the results
    while ($row = $result->fetch_assoc())
    {
        echo '<tr class="align-middle" style="cursor:pointer" onclick="editApplication(' . $row['ord_id'] . ')">';
        echo '<td>' . $row['ord_id'] . '</td>';
        echo '<td>' . (new DateTimeImmutable($row['ord_date']))->format('n/j/Y') . '</td>';
        echo '<td>' . $row['ord_name'] . '</td>';
        echo '<td><a href="mailto:'. $row['ord_email'] . '">' . $row['ord_email'] . '</a></td>';
        // echo '<td>' . $row['field_list'] . '</td>';
        echo '</tr>';

        $empty = false;
    }

    if ($empty)
    {
        echo '<tr><td class="text-center" colspan="7"><em>No Records</em></td></tr>';
    }

    ?>

    </tbody>
</table>

<a href='index.php?content=detail' class='btn btn-primary' role='button'><i class='fa fa-plus-circle' aria-hidden='true'></i>&nbsp;Order Pizza</a>