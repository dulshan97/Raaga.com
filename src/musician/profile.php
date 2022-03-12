<?php
$css = ['musician-profile.css'];
include '../layout/musician-header.php';
require_once '../../classes/database.php';

$avatar = "/public/images/default-avatar.png";
// check if the visitor is the owner
if ($_GET && $_GET['id'] != currentUserId()) {
	$isOwner = false;
	$musicianID = $_GET['id'];
} else {
	$isOwner = true;
	$musicianID = currentUserID();
}

// check if user is a customer is loged in
if(isset($_SESSION) && $_SESSION['user_type'] == 'customer'){
	$isCustomerLoged = true;
} else {
	$isCustomerLoged = false;
}

$dbCon = dbConnect();
$sql = "select m.*, u.email from musicians m join users u on m.user_id = u.id where m.id = {$musicianID}";
$dataRecord = $dbCon->query($sql);
$musician = $dataRecord->fetch_assoc();

?>

<div class="container-fluid">
	<div class="row">
		<!-- bio column -->
		<div class="col-2 height-100">
			<div class="avatar">
				<img src="<?php echo $musician['avatar'] ? $musician['avatar'] : $avatar; ?>" class="rounded mx-auto d-block" alt="...">
			</div>
			<div>
				<h3><?php echo $musician['name']; ?></h3>
				<p class="font-italic"> <?php echo $musician['tagline']; ?></p>
			</div>
			<div>
				<p class="font-weight-bold">About Us</p>
				<p class="text-muted">
				<?php echo $musician['description']; ?>
				</p>
			</div>
		</div>

		<!-- content column -->
		<div class="col-10">
			<div class="container">
				<div class="row align-items-center profile-widget">					
					<div class="col top-bar-profile">
						<div class="display-4">34</div>
						<div class="title"><strong>Likes</strong></div>
					</div>					<div class="col top-bar-profile">
						<div class="display-4">10</div>
						<div class="title"><strong>Requests</strong></div>
					</div>
					<div class="col top-bar-profile">
						<div class="display-4">6</div>
						<div class="title"><strong>Jobs</strong></div>
					</div>
					<div class="col top-bar-profile">
						<div class="display-4">35</div>
						<div class="title"><strong>Posts</strong></div>
					</div>
					<!-- <div class="col top-bar-profile">
						<div class="display-4">5</div>
						<div class="title"><strong>Rating</strong></div>
					</div> -->
				</div>			
			</div>

			<!-- toolbar -->
			<div class="d-flex justify-content-around">
				<?php if($isOwner){ ?>
					<div class="p-2 bd-highlight">
						<button type="button" class="btn btn-outline-dark btn-lg" data-toggle="modal" data-target="#appointment-list-modal"> 
							<i class="fas fa-calendar-alt"></i> Appointments
						</button>
					</div>

					<div class="p-2 bd-highlight">
						<button type="button" class="btn btn-outline-dark btn-lg" data-toggle="modal" data-target="#add-post-modal"> 
							<i class="fas fa-image"></i> Add Post
						</button>
					</div>

					<div class="p-2 bd-highlight">
						<a href="/src/musician/setting.php" type="button" class="btn btn-outline-dark btn-lg"> 
							<i class="fas fa-cogs"></i> Setting
						</a>
					</div>

				<?php } else { ?>
					<div class="p-2 bd-highlight">
						<button type="button" class="btn btn-outline-dark btn-lg" data-toggle="modal" data-target="#appointment-modal"> 
							<i class="fas fa-calendar-alt"></i> Make Appointment
						</button>
					</div>
					<div class="p-2 bd-highlight">
						<button type="button" class="btn btn-outline-dark btn-lg" data-toggle="modal" data-target="#contacts-modal"> 
							<i class="fas fa-address-card"></i> Contact
						</button>
					</div>
					<div class="p-2 bd-highlight">
						<button type="button" class="btn btn-outline-dark btn-lg"> 
							<i class="fas fa-thumbs-up"></i> Like
						</button>
					</div>
				<?php } ?>
			</div>

			<!-- gallery -->
			<div class="gallery">
				<div class="gallery-item">
					<img src="/public/images/slide-1.jpg">
					<div class="caption">
						<p class="font-weight-bold">image 1</p>
						<i class="fas fa-thumbs-up"></i>
					</div>
				</div>

				<div class="gallery-item">
					<img src="/public/images/slide-3.jpeg">
					<div class="caption">
						<p class="font-weight-bold">image 1</p>
						<i class="fas fa-thumbs-up"></i>
					</div>
				</div>

				<div class="gallery-item">
					<img src="/public/images/slide-4.jpeg">
					<div class="caption">
						<p class="font-weight-bold">image 1</p>
						<i class="fas fa-thumbs-up"></i>
					</div>
				</div>

				<div class="gallery-item">
					<img src="/public/images/slide-2.jpg">
					<div class="caption">
						<p class="font-weight-bold">image 1</p>
						<i class="fas fa-thumbs-up"></i>
					</div>
				</div>

				<div class="gallery-item">
					<img src="/public/images/slide-3.jpeg">
					<div class="caption">
						<p class="font-weight-bold">image 1</p>
						<i class="fas fa-thumbs-up"></i>
					</div>
				</div>

				<div class="gallery-item">
					<img src="/public/images/slide-1.jpg">
					<div class="caption">
						<p class="font-weight-bold">image 1</p>
						<i class="fas fa-thumbs-up"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php if(!$isOwner) { ?>
<!-- Make appointment modal -->
<div class="modal fade" id="appointment-modal" tabindex="-1" role="dialog" aria-labelledby="appointment-modal-title" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="#appointment-modal-title">Make an appointment</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php if($isCustomerLoged) {?>
				<?php } else { ?>
					<p class="lead">
						Make appointments will be available once you loged in to the system.
					</p>
				<?php } ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>

<!-- Contact details modal -->
<div class="modal fade" id="contacts-modal" tabindex="-1" role="dialog" aria-labelledby="contacts-modal-title" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="contacts-modal-title">Contact details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container">
				<div class='row'>
						<div class='col'>
							<strong>Address</strong>
						</div>
						<div class='col'>
							<address>
								<?php echo $musician['address_line1'] ? $musician['address_line1'] . '</br>' : '';?>
								<?php echo $musician['address_line2'] ? $musician['address_line2'] . '</br>' : '';?>
								<?php echo $musician['address_line3'] ? $musician['address_line3'] . '</br>' : '';?>
								<?php echo $musician['address_line5'] ? $musician['address_line5'] . '</br>' : '';?>
							</address>
						</div>
					</div>
					<div class='row'>
						<div class='col'>
							<strong>Phone No.</strong>
						</div>
						<div class='col'>
							<address><?php echo $musician['phone_no'];?></address>
						</div>
					</div>
					<div class='row'>
						<div class='col'>
							<strong>e-mail</strong>
						</div>
						<div class='col'>
							<address><?php echo $musician['email'];?></address>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<?php
  include '../layout/footer.php';
?>