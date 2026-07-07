<?php

function logActivity($conn, $user_id, $activity)
{
    $activity = mysqli_real_escape_string(
        $conn,
        $activity
    );

    mysqli_query(

        $conn,

        "INSERT INTO audit_log
        (
            user_id,
            activity,
            activity_date
        )

        VALUES
        (
            '$user_id',
            '$activity',
            NOW()
        )"

    );
}

?>