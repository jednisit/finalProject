<script>
        $(document).ready(function () {
            $("#search").keyup(function () {
                var text = $('#search').val();
                if (text == "") {
                    $("#display").html(" ");
                } else {
                    $.ajax({
                        type: "POST",
                        url: "search.php",
                        data: {
                            search: text
                        },
                        success: function (response) {
                            $("#display").html(response);
                        },
                        error: function () {
                            $("#display").html("something wrong with ajax...!!");
                        }
                    });
                }
            });
        });
</script>
<?php 
include 'connect.php';
$search_item = $_POST['search'];
$query = "select * from mindphp where program like '%".$search_item."%'";
$result = mysqli_query($conn, $query) or die("Query failed");
$output = '';
if(mysqli_num_rows($result) > 0){
	$output .= '<ol>';
	while($row = mysqli_fetch_array($result)){
		$output .= '<li>'.$row["program"].'</li>';
    }
	$output .= '</ol>';
}else{
	$output .= '<p>ไม่พบข้อมูล</p>';
}
echo $output;
?>