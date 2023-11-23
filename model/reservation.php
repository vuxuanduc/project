<?php
    // Kiểm tra phòng ;
    function checkRoom($roomID , $check_in_date , $check_out_date) {
        $conn = connectDB() ;
        $sql = "SELECT 1
        FROM room r
        WHERE r.RoomID = $roomID
          AND NOT EXISTS (
            SELECT 1
            FROM reservation res
            WHERE res.RoomID = r.RoomID
              AND ('$check_in_date' BETWEEN res.`Check_In_Date` AND res.`Check_Out_Date`
                OR '$check_out_date' BETWEEN res.`Check_In_Date` AND res.`Check_Out_Date`)
          );
        " ;
        $result = $conn -> query($sql) -> fetchAll() ;
        return $result ;
    }

    // Đặt phòng ;
    function bookingRoom($UserID , $RoomID , $ReservationDate , $Check_In_Date , $Check_Out_Date , $Price , $TotalAmount , $Status) {
        $conn = connectDB() ;
        $sql = "INSERT INTO `reservation` (`UserID` , `RoomID` , `ReservationDate` , `Check_In_Date` , 
        `Check_Out_Date` , `Price` , `TotalAmount` , `StatusID`) VALUES('$UserID' , '$RoomID' , 
        '$ReservationDate' , '$Check_In_Date' , '$Check_Out_Date' , '$Price' , '$TotalAmount' , '$Status')" ;
        $result = $conn -> query($sql) ;
        echo '<script type="text/javascript">window.location.href = "?action=historyBookingRoom";</script>';
    }

    // Top 10 khách sạn có lượt đặt phòng nhiều nhất ;
    function topReservationHotel() {
        $conn = connectDB() ;
        $sql = "SELECT
        h.`HotelID`,
        h.`NameHotel`,
        h.`Image` ,
        COUNT(r.`ReservationID`) AS `TotalReservations`
        FROM
            `hotel` h
        JOIN
            `room` ro ON h.`HotelID` = ro.`HotelID`
        JOIN
            `reservation` r ON ro.`RoomID` = r.`RoomID`
        GROUP BY
            h.`HotelID`, h.`NameHotel` , h.`Image`
        ORDER BY
            `TotalReservations` DESC
        LIMIT 10;
        " ;
        $result = $conn -> query($sql) -> fetchAll() ;
        return $result ;
    }

    // Quản lí danh sách đặt phòng trong trang admin ;
    function reservation() {
        $conn = connectDB() ;
        $sql = "SELECT h.`NameHotel` , ro.`RoomName` , u.`Email`, s.`NameStatus` , r.*
        FROM `reservation` r JOIN `user` u ON r.`UserID` = u.`UserID`
        JOIN `room` ro ON r.`RoomID` = ro.`RoomID`
        JOIN `hotel` h ON h.`HotelID` = ro.`HotelID`
        JOIN `status` s ON s.`StatusID` = r.`StatusID` ORDER BY `ReservationDate` DESC" ;
        $result = $conn -> query($sql) -> fetchAll() ;
        return $result ;
    }

    // Lấy danh sách đặt phòng theo id người dùng ;
    function reservationUserID($UserID) {
        $conn = connectDB() ;
        $sql = "SELECT h.`NameHotel` , ro.`RoomName` , s.`NameStatus` , r.* FROM `reservation` r
        JOIN `room` ro ON ro.`RoomID` = r.`RoomID`
        JOIN `hotel` h ON h.`HotelID` = ro.`HotelID`
        JOIN `status` s ON s.`StatusID` = r.`StatusID`
        WHERE `UserID` = '$UserID'
        ORDER BY `ReservationDate` DESC" ;
        $result = $conn -> query($sql) -> fetchAll() ;
        return $result ;
    }

    // Kiểm tra xem người dùng đã từng đặt phòng tại khách sạn đó hay chưa để hiển thị nút đánh giá ;
    function checkBooking($UserID , $HotelID) {
        $conn = connectDB() ;
        $sql = "SELECT h.`HotelID` , ro.`RoomName` , r.`ReservationID` , r.`StatusID` FROM `reservation` r
        JOIN `room` ro ON ro.`RoomID` = r.`RoomID`
        JOIN `hotel` h ON h.`HotelID` = ro.`HotelID`
        WHERE `UserID` = '$UserID' AND h.`HotelID` = '$HotelID'" ;
        $result = $conn -> query($sql) -> fetch();
        return $result ;
    }

    // Hủy đặt phòng khách sạn ;
    function cancelBookingRoom($ReservationID) {
        $conn = connectDB() ;
        $sql = "UPDATE `reservation` SET `StatusID` = '3' WHERE `ReservationID` = '$ReservationID' " ;
        $result = $conn -> query($sql) ;
        echo '<script type="text/javascript">window.location.href = "?action=historyBookingRoom";</script>';
    }
?>