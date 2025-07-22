<?php
		require '../config/connection.php';
		error_reporting(E_ALL & ~E_NOTICE);
         if(isset($_POST['submit'])){
            $cattlename = $_POST['cattlename'];
            $cattletype = $_POST['cattletype'];
            $breed = $_POST['breed'];
            $Date_Of_Birth = $_POST['Date_Of_Birth'];
            $lifecycle_Status = $_POST['lifecycle_Status'];
            $milking = $_POST['milking'];
            $Health_Status = $_POST['Health_Status'];
            $ReproductionStatus = $_POST['slct2'];
            $Lastheat = $_POST['Lastheat'];
            $LastAI = $_POST['LastAI'];
            $Lastcalving = $_POST['Lastcalving'];

            $PashuAadhar = $_POST['PashuAadhar'];
            $Weight = $_POST['Weight'];
            $IdentificationMark = $_POST['IdentificationMark'];

            $Mother = $_POST['Mother'];
            $Father = $_POST['Father'];
            $calfname = $_POST['calf11details'];

            $sex = $_POST['sex'];
            $calfbdate = $_POST['calfbdate'];
            $calffather = $_POST['calffather'];

			// Fetch existing data
			$sql = "SELECT * FROM farm_setup";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result);

			$inputDate = $_POST['LastAI'];
            // Create DateTime object from input
            $date = new DateTime($inputDate);
            
            $daysToAdd=$row["Pregnancy_Period"]-$row["Dry_off_period"];

            $date->modify("+$daysToAdd days");    
            
            // Format dates for display
            $calculatedDate = $date->format('Y-m-j');
            $inputDate = (new DateTime($inputDate))->format('F j, Y');
            
            // Create result message
            $result=$calculatedDate;
        
			$Dry_Off_Date = $result;

            $query="INSERT INTO cattle VALUES ('','$cattlename','$cattletype','$breed','$Date_Of_Birth','$lifecycle_Status','$milking','$Health_Status','$ReproductionStatus','$Lastheat','$LastAI','$Lastcalving','$PashuAadhar','$Weight','$IdentificationMark','$Mother','$Father','$calfname','$calfname','$sex','$calfbdate','$calffather','$Dry_Off_Date')";
			mysqli_query($conn,$query );
			
		}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Cattle</title>
	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
<div class="head">
	<h1>Add Cattle</h1>
</div>
<div class="header" id="header">
	<ul>
		<li class="active form_1_progessbar">
			<div>
				<p>1</p>
			</div>
		</li>
		<li class="form_2_progessbar">
			<div>
				<p>2</p>
			</div>
		</li>
		<li class="form_3_progessbar">
			<div>
				<p>3</p>
			</div>
		</li>
		<li class="form_4_progessbar">
			<div>
				<p>4</p>
			</div>
		</li>
	</ul>
</div>
<div class="wrapper">
	<div class="form_wrap">
	<form action="#" method="post" id="form">
		<div class="form_1 data_info">
			<h2>Basic Details</h2>
			
				<div class="form_container">
					<div class="input_wrap">
						<label for="Cattle name">Cattle name *</label>
						<input type="text" name="cattlename" class="input" id="cattlename" >
					</div>
					<div class="input_wrap">
						<label for="Type">cattle Type *</label>
						<select name="cattletype" id="parent_select" onchange="pop(this.id,'breed')">
							<option>--Choose--</option>
							<option value="cow">Cow</option>
							<option value="buffalo">Buffalo</option>
						</select>
					</div>
					<div class="input_wrap">
						<label for="Type">Breed *</label>
						<select id="breed" name="breed"></select>
					</div>
					<div class="input_wrap">
						<label for="Date_Of_Birth">Date Of Birth</label>
						<input type="date" name="Date_Of_Birth" class="input" id="Date_Of_Birth" min="2000-01-01" max="<?php echo Date("Y-m-d"); ?>" >
					</div>
					<div class="input_wrap">
						<label for="Lifecycle_Status">Lifecycle Status *</label>
						<select name="lifecycle_Status" id="lifecycle_Status"   onchange="changeDropdown(this.value)" onclick="populate(this.id,'slct2')">                            
                            <option value="calf">Calf</option>
							<option value="heifer">Heifer</option>
							<option value="adult" selected>Adult</option>
							<option value="retired">Retired</option>
						</select>
					</div>
					
					<div class="input_wrap" id="milk"  > 
						<label for="milking">Milking</label>
						<select name="milking" id="milking" >
							<option value="lactating">Lactating</option>
							<option value="dry">Dry</option>
						</select>
					</div>
					<div class="input_wrap" >
						<label for="Health_Status">Health Status</label>
						<select name="Health_Status" id="Health_Status">
							<option value="Good">Good</option>
							<option value="Not Good">Not Good</option>
							
						</select>
					</div>
				</div>
			
		</div>
		<div class="form_2 data_info" style="display: none" >
			<h2>Reproduction Details</h2>
			
				<div class="form_container" id="Reproduction_Details">
					<div class="input_wrap" id="heifer1">
						<label for="user_name">Reproduction Status</label>
						<select name="slct2" id="slct2" value="slct2"></select>	
						</select>
					</div>

					<div class="input_wrap">
						<label for="Last heat">Date of Last Heat </label>
						<input type="date" name="Lastheat" class="input" id="Lastheat" min="2000-01-01" max="<?php echo Date("Y-m-d"); ?>">
					</div>
					<div class="input_wrap">
						<label for="Last AI">Date of Last AI </label>
						<input type="date" name="LastAI" class="input" id="LastAI" min="2000-01-01" max="<?php echo Date("Y-m-d"); ?>">
					</div>
					<div class="input_wrap" id="calving">
						<label for="Last calving">Date of Last Calving </label>
						<input type="date" name="Lastcalving" class="input" id="Lastcalving" min="2000-01-01" max="<?php echo Date("Y-m-d"); ?>">
					</div>
				</div>
			
		</div>
		<div class="form_3 data_info" style="display: none;">
			<h2>Identification Details</h2>
			
				<div class="form_container">
					<div class="input_wrap">
						<label for="user_name">Pashu Aadhar Number(Govt ID)</label>
						<input type="text" name="PashuAadhar" class="input" id="PashuAadhar">
					</div>
					<div class="input_wrap">
						<label for="first_name">Weight(KG)</label>
						<input type="number" name="Weight" class="input" id="Weight">
					</div>
					<div class="input_wrap">
						<label for="last_name">Identification Mark</label>
						<input type="text" name="IdentificationMark" class="input" id="IdentificationMark">
					</div>
				</div>
			
		</div>
		<div class="form_4 data_info" id="form_4" style="display: none;">
			 <h2>Parent Details</h2>
			
				<div class="form_container">
					<div class="input_wrap">
						<label for="Mother">Mother</label>
						<input type="text" name="Mother" class="input" id="Mother">
					</div>
					<div class="input_wrap">
						<label for="Father">Father</label>
						<input type="text" name="Father" class="input" id="Father">
					</div>
				 <div id="calfdetails">
					<h2>Calf Details</h2>
					<div class="input_wrap" id="calf1details">
						<label for="calfdetails">Calf Detail</label>
						<input type="text" name="calf11details" class="input" id="calf11details">
					</div>
				 </div>	
			
				</div>
			
		</div>
		<div class="form_5 data_info" style="display: none;" id="calfdetail">
		<h2>Calf Details</h2>
		
			<div id="form_container">
				<div class="input_wrap">
				<label for="calfname">Calf Name</label>
						<input type="text" name="calfname" class="input" id="calfname">
				</div>
				<div class="input_wrap">
					<label for="Type">Sex</label>
					<select name="sex" id="Sex">
						<option>--Choose--</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
					
				</div>
					<div class="input_wrap">
						<label for="calfname">Date of Birth</label>
								<input type="date" name="calfbdate" class="input" id="calfbdate" min="2000-01-01" max="<?php echo Date("Y-m-d"); ?>">
						</div>
						<div class="input_wrap">
							<label for="Father">Father</label>
									<input type="text" name="calffather" class="input" id="calffather">
							</div>
			</div>	
		
		</div>
		</form> 
	</div>
	<div class="btns_wrap">
		<div class="common_btns form_1_btns">
			<button type="button" class="btn_next">Next <span class="icon"><ion-icon name="arrow-forward-sharp"></ion-icon></span></button>
		</div>
		<div class="common_btns form_2_btns" style="display: none;">
			<button type="button" class="btn_back"><span class="icon"><ion-icon name="arrow-back-sharp"></ion-icon></span>Back</button>
			<button type="button" class="btn_next">Next <span class="icon"><ion-icon name="arrow-forward-sharp"></ion-icon></span></button>
		</div>
		<div class="common_btns form_3_btns" style="display: none;">
			<button type="button" class="btn_back"><span class="icon"><ion-icon name="arrow-back-sharp"></ion-icon></span>Back</button>
			<button type="button" class="btn_next">Next</button>
		</div>
		<div class="common_btns form_4_btns" style="display: none;">
			<button type="button" class="btn_back"><span class="icon"><ion-icon name="arrow-back-sharp"></ion-icon></span>Back</button>
			
			<button type="submit" class="btn_done" form="form" name="submit">Done</button>
		</div>
		<div class="common_btns form_5_btns" style="display: none;">
			<button type="button" class="btn_back"><span class="icon"></span>Done</button>
		</div>
	</div>
</div>

<div class="modal_wrapper">
	<div class="shadow"></div>
	<div class="success_wrap">
		<span class="modal_icon"><ion-icon name="checkmark-sharp"></ion-icon></span>
		<p>You have successfully completed the process.</p>
	</div>
</div>

<script type="text/javascript" src="script.js"></script>
<script>
		
	function pop(s1,s2)
	{
		var s1 = document.getElementById(s1);
		var s2 = document.getElementById(s2);

		s2.innerHTML = "";

		if(s1.value == "cow")
		{
			var optionArray = ['HF|HF',"HF Cross|HF Cross","Jersey|Jersey","Jersey cross|Jersey cross","|Gir","Sahiwal|Sahiwal"];
		}
		else if(s1.value  == 'buffalo')
		{
			var optionArray = ["Mrathwadi|Mrathwadi","Murrah|Murrah"];
		}

		for(var option in optionArray)
		{
			var pair = optionArray[option].split("|");
			var newoption = document.createElement("option");

			newoption.value = pair[0];
			newoption.innerHTML=pair[1];
			s2.options.add(newoption);
		}

	}
	function populate(s1,s2)
		{
			var s1 = document.getElementById(s1);
			var s2 = document.getElementById(s2);

			s2.innerHTML = "";

			if(s1.value == "heifer")
			{
				var optionArray = ['Ready for Breeding|Ready For Breeding','open|Open','inseminated|Inseminated','pregnant|Pregnant'];
			}
			else if(s1.value  == 'adult')
			{
				var optionArray = ['open|Open','inseminated|Inseminated','pregnant|Pregnant','fresh|Fresh'];
			}
			else if(s1.value  == 'retired')
			{
				var optionArray = ['NO|NO'];
			}

			for(var option in optionArray)
			{
				var pair = optionArray[option].split("|");
				var newoption = document.createElement("option");

				newoption.value = pair[0];
				newoption.innerHTML=pair[1];
				s2.options.add(newoption);
			}

		}
		
		function changeDropdown()
{
	var status=document.getElementById("lifecycle_Status").value;
	if(status=="calf"||status=="heifer"||status=="retired")
			{
				document.getElementById("milk").style.display='none';
				document.getElementById("milking").disabled= true ;
				
			if(status=="calf")
			{   
				document.getElementById("Reproduction_Details").style.display='none';
				document.getElementById("slct2").disabled= true ;
				document.getElementById("Lastheat").disabled= true ;
				document.getElementById("LastAI").disabled= true ;
				document.getElementById("Lastcalving").disabled= true ;
			}
			else
			{
				document.getElementById("Reproduction_Details").style.display='block';
				document.getElementById("slct2").disabled= false ;
				document.getElementById("Lastheat").disabled= false ;
				document.getElementById("LastAI").disabled= false ;
				document.getElementById("Lastcalving").disabled= false ;
			}	
				
			}

			else
			{
				document.getElementById("milk").style.display='block';
				document.getElementById("milking").disabled= false ;
				document.getElementById("calving").style.display='block';
				
				
			}
			
			if(status=="calf"||status=="heifer")
				{	

					document.getElementById("calving").style.display='none';
					document.getElementById("calfdetails").style.display='none';
					document.getElementById("Lastcalving").disabled= true ;
					document.getElementById("calf11details").disabled= true ;
					document.getElementById("calfname").disabled= true ;
					document.getElementById("Sex").disabled= true ;
					document.getElementById("calfbdate").disabled= true ;
					document.getElementById("calffather").disabled= true ;
				}
			else
			{
				document.getElementById("calving").style.display='block';
				document.getElementById("calfdetails").style.display='block';
				document.getElementById("Lastcalving").disabled= false ;
				document.getElementById("calf11details").disabled= false ;
				document.getElementById("calfname").disabled= false ;
				document.getElementById("Sex").disabled= false ;
				document.getElementById("calfbdate").disabled= false ;
				document.getElementById("calffather").disabled= false ;

			}
}
</script>

</body>
</html>