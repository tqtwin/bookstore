<?php
class Database
{
    public function GetData($sql)
    {
        require("connect-mysql.php");
        try {
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                throw new Exception("Lỗi thực thi câu lệnh SQL, lỗi: " . mysqli_error($conn));
            }
            
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        } finally {
            mysqli_close($conn);
        }
    }

    public function ExecuteSQL($sql)
    {
        require("connect-mysql.php");

        try {
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                throw new Exception("Lỗi thực thi câu lệnh SQL, lỗi: " . mysqli_sqlstate($conn) );
            }

            $num = mysqli_affected_rows($conn);
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            mysqli_close($conn);

            return $num;
        }
    }
}
?>