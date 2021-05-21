<?php
//job List

class checkboxlist{
	public function sublist()
	{
		echo'
			<div class="divp35"><input type="checkbox" name="sub_list[]" value="Plumber"><span>Plumber</span></div>
			<div class="divp35"><input type="checkbox" name="sub_list[]" value="House Cleaner"><span>House Cleaner</span></div>
			<div class="divp35"><input type="checkbox" name="sub_list[]" value="Gardener"><span>Gardener</span></div>
			<div class="divp35"><input type="checkbox" name="sub_list[]" value="Electrician"><span>Electrician</span></div>
			<div class="divp35"><input type="checkbox" name="sub_list[]" value="Refrigerator repair"><span>Refrigerator repair</span></div>
			<div class="divp35"><input type="checkbox" name="sub_list[]" value="AC mechanic"><span>AC mechanic</span></div>
			<div class="divp35"><input type="checkbox" name="sub_list[]" value="Mobile Repair"><span>Mobile Repair</span></div>
			<div class="divp35"><input type="checkbox" name="sub_list[]" value="Carpenter"><span>Carpenter</span></div>
			<div class="divp35"><input type="checkbox" name="sub_list[]" value="Wall Painter"><span>Wall Painter</span></div>
			<div class="divp35"><input type="checkbox" name="sub_list[]" value="Furniture fixer"><span>Furniture Fixer</span></div>
			<div class="divp35"><input type="checkbox" name="sub_list[]" value="Sanitary"><span>Sanitary</span></div>
			<div class="divp35"><input type="checkbox" name="sub_list[]" value="Tiles-Flooring"><span>Tiles-Flooring</span></div>
			<div class="divp35"><input type="checkbox" name="sub_list[]" value="Floor repair"><span>Floor repair</span></div>
			<div class="divp35"><input type="checkbox" name="sub_list[]" value="Cobbler"><span>Cobbler</span></div>
			<div class="divp35"><input type="checkbox" name="sub_list[]" value="Tailor"><span>Tailor</span></div>
			<div class="divp35"><input type="checkbox" name="sub_list[]" value="Massager"><span>Massager</span></div>
			<div class="divp35"><input type="checkbox" name="sub_list[]" value="Window repair"><span>Window repair</span></div>
			<div class="divp35"><input type="checkbox" name="sub_list[]" value="Thai-glass repair"><span>Thai-glass repair</span></div>
			


		';
	}
	//sub list unchecked box
	public function joblistcombo()
	{
		echo'
			<select name="joblistcombo" style="width: 180px;">
					
			  <option value="None">None</option>
			  <option value="Plumber">Plumber</option>
			  <option value="House Cleaner">House Cleaner</option>
			  <option value="Gardener">Gardener</option>
			  <option value="Electrician">Electrician</option>
			  <option value="Refrigerator repair">Refrigerator repair</option>
			  <option value="AC mechanic">AC mechanic</option>
			  <option value="Mobile repair">Mobile repair</option>
			  <option value="Carpenter">Carpenter</option>
			  <option value="Wall Painter">Wall Painter</option>
			  <option value="Furniture fixer">Furniture fixer</option>
			  <option value="Sanitary">Sanitary</option>
			  <option value="Tiles-Flooring">Tiles-Flooring</option>
			  <option value="Floor repair">Floor repair</option>
			  <option value="Cobbler">Cobbler</option>
			  <option value="Tailor">Tailor</option>
			  <option value="Massager">Massager</option>
			  <option value="Window repair">Window repair</option>
			  <option value="Thai-glass repair">Thai-glass repair</option>
			</select>


		';
	}

	public function classlist()
	{
		echo '
			<div class="divp35"><input type="checkbox" name="class_list[]" value="Amateur"><span>Amateur</span></div>
			<div class="divp35"><input type="checkbox" name="class_list[]" value="Semi-expert"><span>Semi-expert</span></div>
			<div class="divp35"><input type="checkbox" name="class_list[]" value="Expert"><span>Expert</span></div>
			<div class="divp35"><input type="checkbox" name="class_list[]" value="Professional"><span>Professional</span></div>
		';
	}

	public function classlistcombo()
	{
		echo '
			<select style="width: 180px;" name="classlistcombo">
					
			  <option value="None">None</option>
			  <option value="Amateur">Amateur</option>
			  <option value="Semi-expert">Semi-expert</option>
			  <option value="Expert">Expert</option>
			  <option value="Professional">Professional</option>
			</select>
		';
	}

	public function mediumlist()
	{
		echo '
			<div class="divp35"><input type="checkbox" name="medium_list[]" value="Home"><span>Home</span></div>
			<div class="divp35"><input type="checkbox" name="medium_list[]" value="Office"><span>Office</span></div>
			<div class="divp35"><input type="checkbox" name="medium_list[]" value="Any"><span>Any</span></div>
		';
	}

	public function mediumlistcombo()
	{
		echo '
			<select name="mediumlistcombo" style="width: 180px;">
					
			  <option value="None">None</option>
			  <option value="Home">Home</option>
			  <option value="Office">Office</option>
			  <option value="Any">Any</option>
			</select>
		';
	}
}

?>