<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Jyo | Dashboard</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</head>
<body>
	<?php include('controller.php');?>
	<div class="container">
		<br><br>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-primary">
					<div class="panel-heading">Form</div>
					<div class="panel-body">
						<?php
						if (isset($_GET['update'])) {
							$where = [
								'user_id'=>$_GET['user_id'],
							];
							$data = $obj->select_where('user_tbl',$where);
							foreach ($data as $row) {?>
								<div class="row">
									<div class="col-md-12">
										<form action="controller.php" method="POST" enctype="multipart/form-data">
											<input type="hidden" name="user_id" value="<?php echo $row['user_id']?>">
											<div class="col-md-12"><input type="text" name="name" placeholder="Name" id="" value="<?php echo $row['name']?>" class="form-control"></div>
											<div class="col-md-12"><input type="text" name="email" placeholder="Email" id="" value="<?php echo $row['email']?>" class="form-control"></div>
											<div class="col-md-12"><img src="assets/image/<?php echo $row['photo']?>" width="80px" height="80px" alt=""></div>
											<input type="hidden" value="<?php echo $row['photo']?>" name="image_path">
											<div class="col-md-12"><div class="form-group">
												<input type="file" name="photo"  placeholder="" id="" class="form-control">
											</div></div>
											<div class="col-md-12">
												<a href="index.php" class="btn btn-default pull-left">Cancel</a>
												<input type="submit" name="update" value="Update" class="btn btn-warning pull-right"></div>
										</form>


									</div>
								</div>
							<?php	}
						}
						else
							{?>

								<div class="row">
									<div class="col-md-12">

										<form action="controller.php" method="POST" enctype="multipart/form-data">
											<div class="col-md-12"><input type="text" name="name" placeholder="Name" id="" class="form-control"></div>
											<div class="col-md-12"><input type="text" name="email" placeholder="Email" id="" class="form-control"></div>
											<div class="col-md-12"><div class="form-group">
												<input type="file" name="photo" placeholder="" id="" class="form-control">
											</div></div>
											<div class="col-md-12"><input type="submit" name="submit" class="btn btn-primary pull-right"></div>
										</form>
									</div>
								</div>


								<?php
							}
							?>

						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered">

						<thead>
							<th>SL</th>
							<th>Name</th>
							<th>Email</th>
							<th>Photo</th>
							<th>Date</th>
							<th>Action</th>
						</thead>
						<?php 
						$data = $obj->select_all('user_tbl');
						$count = 1;
						foreach ($data as $row) {?>
							<tr>
								<td><?php echo $count++; ?></td>
								<td><?php echo $row['name']; ?></td>
								<td><?php echo $row['email']; ?></td>
								<td><img src="assets/image/<?php echo $row['photo']; ?>" width="30px" height="30px" alt=""></td>
								<td><?php echo $row['date']; ?></td>
								<td><a href="index.php?update=1&user_id=<?php echo $row['user_id']?>" class="btn btn-xs btn-primary">Edit</a>
									&nbsp;&nbsp;
								<a href="controller.php?delete=1&user_id=<?php echo $row['user_id']?>" class="btn btn-xs btn-danger">Delete</a>
								</td>
							</tr>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</body>
	</html>