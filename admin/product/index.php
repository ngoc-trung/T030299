<?php
    require_once ('../../db/dbhepler.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>Quản Lý Sản Phẩm</title>
</head>
<body>
<header>
            <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link " href="../category/">Quản lý danh mục</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#">Quản lý sản phẩm</a>
        </li>
            </ul>
    	</header>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Quản Lý Sản Phẩm</h2>
			</div>
			<div class="panel-body">
			<a href="addproduct.php">
			<button class="btn btn-success" style="
			margin-bottom: 15px;">Thêm Sản Phẩm</button>
			</a>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th width="50px">STT</th>
						<th>Tên Sản Phẩm</th>
						<th >Hình Ảnh</th>
                        <th >Giá Bán</th>
                        <th >Danh Mục</th>
						<th >Ngày Cập Nhập</th>
					</tr>
				</thead>
				<tbody>
<?php
	// lay danh sach danh muc tu database
	$sql = 'select product.id, product.title, product.price, product.thumbnail,
    product.updated_at, category.name category_name from product left join category on 
    product.id_category = category.id';
	$productList = executeResult($sql);

	$index = 1;
	foreach ($productList as $item) {
        echo '<tr>
                    <td>'.($index++).'</td>
                    <td>'.$item['title'].'</td>
                    <td><img src="'.$item['thumbnail'].'" 
                    style ="max-width: 100px"/></td>
                    <td>'.$item['price'].'</td>
                    <td>'.$item['category_name'].'</td>
                    <td>'.$item['updated_at'].'</td>
                    <td>
                        <a href="addproduct.php?id='.$item['id'].'"><button class="btn btn-warning">Sửa</button></a>
                    </td>
                    <td>
                        <button class="btn btn-danger" onclick="deleteProduct('.$item['id'].')">Xoá</button>
                    </td>
                </tr>';
    }

    if (!empty($_POST)) {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
    
            switch ($action) {
                case 'delete':
                    if (isset($_POST['id'])) {
                        $id = $_POST['id'];
    
                        $sql = 'delete from product where id = '.$id;
                        execute($sql);
                    break;
            }	}
                
        }
    }
?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
    <script type="text/javascript">
		function deleteProduct(id) {

            var option = confirm('Bạn có chắc chắn muốn xoá danh mục này không?')
			if(!option) {
				return;
			}

			console.log(id)
			//ajax - lenh post
			$.post('ajax.php', {
				'id': id,
				'action': 'delete'
			}, function(data) {
				location.reload()
			})
		}
	</script>
</body>
</html>