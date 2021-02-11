const profileButton = document.querySelector("#user-img");
profileButton.addEventListener("click", () => {
    window.open("userpage.php", "_self");
});

//This is a clock function I got from a github repository
setInterval(function (){
	var currentTime = new Date();
	var hours = currentTime.getHours();
	var minutes = currentTime.getMinutes();
	var seconds = currentTime.getSeconds();
	var period = "AM";

	if (hours >= 12){
		period = "PM";
	}

	if ( hours > 12){
		hours = hours - 12;
	}

	if (minutes < 10){
		minutes = "0" + minutes;
	}

	if (seconds < 10){
		seconds = "0" + seconds;
	}

	var clockTime = hours + ":" + minutes + ":" + seconds + " " + period;
	var clock = document.getElementById('clock');

	clock.innerText = clockTime;

}, 1000);

//Getting the create button, checkboxes, header input, content input and
//an array of the input & textarea named goalInputs for later use
const createGoalButton = document.querySelector("#createGoalBtn");
const checkBoxes = document.querySelectorAll(".new_goal_boxes");
const headerText = document.querySelector("#header-input");
const contentText = document.querySelector("#content-textarea");
const goalInputs = document.querySelectorAll(".input_goal");

//Declaring the repeat variable
//This variable will represent which one of the checkboxes has been checked
//If you selected "repeat every day", this variable will be set to that
var repeat;

//Getting the two counters from the "goal div" inputs
const headerCharsCount = document.querySelector("#chars-header-input");
const contentCharsCount = document.querySelector("#chars-textarea");

//Declaring variable of character amount in header input
goalInputs.forEach(input => {
	charAmount = 0;
	input.addEventListener("input", () => {
		//Increasing the variable based on header length
		charAmount = input.value.length;
		//Setting the HTML elements value to match "headerCharAmount"
		//Also I added a "/20" at the end to show how many characters you can write
		if(input.id == "header-input") {
			headerCharsCount.innerHTML = charAmount + "/20";
		} else {
			contentCharsCount.innerHTML = charAmount + "/20";
		}


	});
});


createGoalButton.addEventListener("click", () => {
	//Start gaining information and submitting to database
	//Looping through the checkboxes
	for(var i = 0; i<checkBoxes.length; i++) {
		//Checking if a checkbox is checked
		if(checkBoxes[i].checked) {
			//Assigning value to the "repeat" variable
			repeat = checkBoxes[i].getAttribute("name");
			//Checking if both header and content has been written by user
			if(headerText.value && contentText.value) {
				//Declaring variables
				var header = headerText.value;
				var content = contentText.value;
				//Checking the length of header value
				if(header.length > 20) {
					alert("För lång rubrik!");
				}
				//Checking the length of content value
				if(content.length > 500) {
					alert("För lång brödtext!");
				}
			}
		}
	}

});