<?php
include '../connection.php'; // Include the database connection script

// Retrieve donation data
$donation_id = $_POST['donation_id'] ?? null; // Using null coalescing operator to set default value
if (!$donation_id) {
    echo "Donation ID is missing.";
    exit;
}

// Prepare and execute query to fetch donation location
$donation_query = "SELECT location FROM donations WHERE id = ?";
$donation_stmt = $pdo->prepare($donation_query);
$donation_stmt->execute([$donation_id]);
$donation = $donation_stmt->fetch(PDO::FETCH_ASSOC);

if ($donation) {
    // Retrieve delivery persons' locations
    $delivery_persons_query = "SELECT Did, city FROM delivery_persons";
    $delivery_persons_stmt = $pdo->query($delivery_persons_query);
    $delivery_persons = $delivery_persons_stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check for matching locations and assign delivery person
    $assigned_delivery_person_id = null;
    foreach ($delivery_persons as $delivery_person) {
        if ($delivery_person['city'] === $donation['location']) {
            $assigned_delivery_person_id = $delivery_person['Did'];
            break; // Exit loop once a match is found
        }
    }

    if ($assigned_delivery_person_id !== null) {
        // Update donation record with assigned delivery person
        $update_query = "UPDATE donations SET assigned_to = ? WHERE id = ?";
        $update_stmt = $pdo->prepare($update_query);
        $update_stmt->execute([$assigned_delivery_person_id, $donation_id]);
        
        // Check if the update was successful
        if ($update_stmt->rowCount() > 0) {
            echo "Donation assigned to delivery person successfully.";
        } else {
            echo "Failed to assign donation to a delivery person.";
        }
    } else {
        echo "No delivery person available in the donor's location.";
    }
} else {
    echo "Donation not found.";
}
?>
