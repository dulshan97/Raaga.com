<?php
$css = ['settings-page.css'];
include '../layout/musician-header.php';

require_once '../../classes/database.php';

// check if user is a musician
if(isset($_SESSION) && $_SESSION['user_type'] == 'customer'){
	header('Location: /');
}
$dbCon = dbConnect();
$musicianID = currentUserID();

if ($_POST) {
	$userId = currentUserId();

	$id = $_POST['id'];
	$name = $_POST['name'];
	$phoneNo = $_POST['name'];
	$addressLine1 = $_POST['addressLine1'];
	$addressLine2 = $_POST['addressLine2'];
	$addressLine3 = $_POST['addressLine3'];
	$addressLine4 = $_POST['addressLine4'];
	// $avatar = $_POST['avatar'];
	$avatar = null;
	$tagline = $_POST['tagline'];
	$description = $_POST['description'];
	$fullBand = $_POST['full-band'];
	$threePiece = $_POST['three-piece'];
	$twoPiece = $_POST['two-piece'];

	
	if ($id != null) {
		// if id is not null, it meens user already exist on database. Then update the record
		$sql = "update musicians set name = '{$name}', phone_no = '{$phoneNo}', address_line1 = '{$addressLine1}', address_line2 = '{$addressLine2}', address_line3 = '{$addressLine3}', address_line4 = '{$addressLine4}', tagline = '{$tagline}', description = '{$description}', full_band_price = {$fullBand}, three_piece_price = {$threePiece}, two_piece_price = {$twoPiece} where id = {$musicianID}";
	} else {
		// insert data to settings table
		$sql = "insert into musicians (user_id, name, avatar, tagline, description, full_band_price, three_piece_price, two_piece_price) values ({$userId}, '{$name}', '{$avatar}', '{$tagline}', '{$description}', {$fullBand}, {$threePiece}, {$twoPiece})";
	}


	$result = $dbCon->query($sql);
	if (!$result) {
		die("Error occurd updating musicians table: " . $dbCon->error);
	}

	if ($result && isFirstLogin()) {
		$update = "update users set is_first_login = 0 where id = {$userId}";
		if ($dbCon->query($update)) {
			$_SESSION['is_first_login'] = 0;
			header('Location: /src/musician/profile.php');
		} else {
			die("Error occurd updating users table: " . $dbCon->error);
		}
	}
}
$sql = "select m.*, u.email from musicians m join users u on m.user_id = u.id where m.id = {$musicianID}";
$dataRecord = $dbCon->query($sql);
$musician = $dataRecord->fetch_assoc();	
?>
<?php if (isFirstLogin()) { ?>
	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<h1 class="display-4">Welcome</h1>
			<p class="lead">Tell us some information about your music band, before continue. You can change given data anytime at settings page.</p>
		</div>
	</div>
<?php } ?>
<div class="container">
	<div class="row">
		<form method="post" action="/src/musician/setting.php" class="col">
			<h2>About the band</h2><hr>

			<div class="form-group col-6">
				<label for="name">Name of the band</label>
				<input type="text" name="name" id="name" class="form-control" value="<?php echo $musician['name']; ?>" placeholder="Marians">
				<input type="hidden" name="id" value="<?php echo $musician['id']; ?>" placeholder="Marians">
			</div>

			<div class="form-group col-6">
				<label for="avatar">Logo of the band</label>
<!-- 
				<div class="avatar">
					<img id="preview" src="/public/images/default-avatar.png">
				</div>
				https://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded
 -->
				<input type="file" name="avatar" id="avatar" class="form-control-file" value="<?php echo $musician['id']; ?>">
			</div>

			<div class="form-group col-6">
				<label for="tagline">Tag line</label>
				<input type="text" name="tagline" id="tagline" class="form-control" value="<?php echo $musician['tagline']; ?>" placeholder="The no.1 band of the island.">
			</div>

			<div class="form-group col-6">
				<label for="name">Breif description about the band</label>
				<textarea name="description" id="description" class="form-control" rows="3"><?php echo $musician['description']; ?></textarea>
			</div>

			<h2>Contact details</h2><hr>
			<div class="form-group col-6">
				<label for="tagline">Phone number</label>
				<input type="text" name="phoneNo" id="phoneNo" class="form-control" value="<?php echo $musician['phone_no']; ?>">
			</div>

			<div class="form-group col-6">
				<label for="tagline">Address</label>
				<input type="text" name="addressLine1" id="addressLine1" class="form-control" value="<?php echo $musician['address_line1']; ?>">
				<input type="text" name="addressLine2" id="addressLine2" class="form-control" value="<?php echo $musician['address_line2']; ?>">
				<input type="text" name="addressLine3" id="addressLine3" class="form-control" value="<?php echo $musician['address_line3']; ?>">
				<input type="text" name="addressLine4" id="addressLine4" class="form-control" value="<?php echo $musician['address_line4']; ?>">
			</div>


			<h2>Pricing</h2><hr>
			<div class="form-group col-6">
				<label for="full-band">Full band</label>
				<input type="number" name="full-band" id="full-band" class="form-control" value="<?php echo $musician['full_band_price']; ?>">
			</div>

			<div class="form-group col-6">
				<label for="three-piece">Three piece</label>
				<input type="number" name="three-piece" id="three-piece" class="form-control" value="<?php echo $musician['three_piece_price']; ?>">
			</div>

			<div class="form-group col-6">
				<label for="two-piece">Two piece</label>
				<input type="number" name="two-piece" id="two-piece" class="form-control" value="<?php echo $musician['two_piece_price']; ?>">
			</div>

			<div class="form-group col-6">
				<?php if (isFirstLogin()) { ?>
					<button type="submit" class="btn btn-primary">Continue</button>
				<?php } else {?>
					<a href="/src/musician/profile.php"  class="btn btn-light">Cancel</a>
					<button type="submit" class="btn btn-primary">Save</button>
				<?php } ?>
			</div>
		</form>
	</div>
</div>

<?php
  include '../layout/footer.php';
?>