<script src="<?=base_url('assets/vendor/jquery/jquery.min.js')?>"></script>


	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Users</h1>
			<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
					class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
		</div>

		<!-- Content Row -->
		<!-- <div class="row"> -->

			<!-- DataTales Example -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>Username</th>
									<th>Full Name</th>
									<th>Email</th>
									<th>Role</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							
							<tbody>
								<?php $i=1; foreach ($users as $key => $value) { ?>

								<tr>
									<td><?=$value['user_name']?></td>
									<td><?=$value['full_name']?></td>
									<td><?=$value['email']?></td>
									<td><?=$value['role_id']?></td>
									<td><?=$value['status']?></td>
									<td>
										<button type="button" href="<?=base_url('user/edit/'.$value['id'])?>" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#editModal<?=$i?>">
											<i class="fas fa-edit"></i>
										</button>

										<!-- Modal Edit -->
										<div class="modal fade" id="editModal<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form method="post" action="<?=base_url('user')?>">
														<div class="form-group">
															<label for="userName">User Name</label>
															<input type="hidden" id="id" name="id" value="<?=$value['id']?>">
															<input type="text" class="form-control" id="userName" name="userName" value="<?=$value['user_name']?>" placeholder="Enter Username">
														</div>
														<div class="form-group">
															<label for="fullName">Full Name</label>
															<input type="text" class="form-control" id="fullName" name="fullName" value="<?=$value['full_name']?>" placeholder="Enter Full Name">
														</div>
														<div class="form-group">
															<label for="email">Email</label>
															<input type="email" class="form-control" id="email" name="email" value="<?=$value['email']?>" placeholder="Enter Your Email">
														</div>
														<div class="form-group">
															<label for="role">Role</label>
															<select class="form-control" name="role" id="role">
																<option value="1" <?=($value['role_id'] == 1) ? 'selected' : '' ?>>Admin</option>
																<option value="2" <?=($value['role_id'] == 2) ? 'selected' : '' ?>>User</option>
															</select>
														</div>
														<div class="form-group">
															<label for="status">Status</label>
															<select class="form-control" name="status" id="status">
																<option value="active" <?=($value['status'] == 'active') ? 'selected' : '' ?>>Active</option>
																<option value="inactive" <?=($value['status'] == 'inactive') ? 'selected' : '' ?>>Inactive</option>
															</select>
														</div>
														<div class="form-group">
															<label for="password">Password</label>
															<input type="password" class="form-control" id="password<?=$i?>" name="password" value="<?=$value['user_pass']?>" placeholder="Password" readonly>
														</div>
														<div class="form-check">
															<input type="checkbox" class="form-check-input" id="changePassword<?=$i?>" name="changePassword">
															<label class="form-check-label" for="changePassword">Change Password</label>
															<script>
																$('#changePassword<?=$i?>').click(function() {
																	if ($(this).is(':checked')) {
																		$('#password<?=$i?>').removeAttr('readonly');
																	} else {
																		$('#password<?=$i?>').attr('readonly', 'readonly');
																	}
																});
															</script>
														</div>
														<!-- <button type="submit" class="btn btn-primary" name="submit">Submit</button> -->
													
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													<button type="submit" class="btn btn-primary" name="submit">Save changes</button>
												</div>
												</form>
												</div>
											</div>
										</div>

										<a href="<?=base_url('user/delete/'.$value['id'])?>" class="btn btn-danger btn-circle btn-sm" id="delete<?=$i?>">
											<i class="fas fa-trash"></i>
										</a>
										<script>
											$('#delete<?=$i?>').click(function() {
												var data = confirm('Are you sure?');
												console.log(data);
												if (data == true) {
													var url = $(this).attr('href');
													$('#content').load(url);
												}
												// if (confirm('Are you sure?')) {
												// 	var url = $(this).attr('href');
												// 	$('#content').load(url);
												// }
											});
										</script>
									</td>
								</tr>
									
								<?php $i++; } ?>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>

		

			

			
		<!-- </div> -->


	</div>
	<!-- /.container-fluid -->




