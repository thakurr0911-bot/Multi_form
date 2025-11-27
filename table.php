<?php
session_start();
include 'db.php';
include 'header.php';
$query = "SELECT * FROM multi_forms ORDER BY id DESC";
$result = mysqli_query($link, $query);
?>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="text-success ">Submitted Form Entries</h3>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td>
                            <?php if (!empty($row['image'])): ?>
                                <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="image" width="60" height="60" style="object-fit:cover;">
                            <?php else: ?>
                                <span class="text-muted">No Image</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center text-danger">No data found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>