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

//Prevent submitting form on enter klick
document.getElementById("goal-form").addEventListener("keypress", (e) => {
	if(e.which == 13) {
		e.preventDefault();
	}
});

//Getting the create button, checkboxes, header input, content input and
//an array of the input & textarea named goalInputs for later use
const createGoalButton = document.querySelector("#createGoalBtn");
const checkBoxes = document.querySelectorAll(".new_goal_boxes");
const headerText = document.querySelector("#header-input");
const tagText = document.querySelector("#goal-input-tags");
const contentText = document.querySelector("#content-textarea");
const goalInputs = document.querySelectorAll(".input_goal");

//Declaring the repeat variable
//This variable will represent which one of the checkboxes has been checked
//If you selected "repeat every day", this variable will be set to that value
var repeat;

//Getting the two counters from the "goal div" inputs
const headerCharsCount = document.querySelector("#chars-header-input");
const contentCharsCount = document.querySelector("#chars-textarea");
const tagCharsCount = document.querySelector("#chars-goal-input");

//This particular container is useful to append tag divs to it
const tagsParentContainer = document.querySelector(".actual_tag_holder");

//This array will hold all tags that get created
var tagsArray = [];

//Declaring variable of character amount in header input
goalInputs.forEach(input => {
	charAmount = 0;
	input.addEventListener("keypress", (e) => {

		//Increasing the variable based on header length
		if(!e.which == 13 || !e.which == 32) {
			charAmount = input.value.length;
		}

		charAmount = input.value.length;

		//Setting the HTML elements value to match "headerCharAmount"
		//Also I added a "/20" at the end to show how many characters you can write
		if(input.id == "header-input") {
			headerCharsCount.innerHTML = charAmount + "/20";
			//Checking if header-input has more characters than allowed
			if(charAmount > 20) {
				headerCharsCount.style.color = "red";
			}
		} else if(input.id == "content-textarea") {
			contentCharsCount.innerHTML = charAmount + "/500";
			//Checking if content-textarea has more characters than allowed
			if(charAmount > 500) {
				contentCharsCount.style.color = "red";
			}
		} else {
			//We know that user is typing in the "tags input" since everything else has been checked
			//We will need to change the value for charAmount before anything else
			charAmount = tagsArray.length;

			tagCharsCount.innerHTML = charAmount + "/5";
			//If the user hits either space or enter, that will create a tag
			//Let's check if the user hits either one of those keys
			if(e.which == 13 || e.which == 32) {
				//Checking if there is any value and that the value cannot be a blankspace
				if(input.value && !input.value.includes(" ")) {
					if(tagsArray.length <= 5) {
						//The reason we'll be doing form validation for the tags right here instead of later
						//is because each tag needs validation before being pushed to the array.
						//You could do it the other way around, but I chose this way
	
						//Now let's create a tag
						//We'll begin with defining the actual tag from the inputs value
						let tagContent = input.value;
	
						//We'll begin checking for invalid characters in the tag 
						//This is easier to do before we put all of them in an array
						var letters = /^.*?(?=[\^%&$\*:<>\?/\{\|\}]).*$/;
						var result = letters.test(tagContent);
						if(result) {
							$("#tags-goal-error-msg").html("Please get rid of the invalid characters!");
							return;
						}
	
						//Now we know the string does not contain invalid characters
						//Lets check if the string contains a hashtag
						if(/#/.test(tagContent)) {
							tagContent = tagContent.replace("#", "");
						}

						//Checking if string contains any spaces
						if(/ /.test(tagContent)) {
							tagContent = tagContent.replace(" ", "");
						}

						//Make the string lowercase to prevent a similar but uppercase string apperaring again
						tagContent = tagContent.toLowerCase();
	
						//Checking if tag already exists in array
						for(var i = 0; i < tagsArray.length; i++) {
							if(tagContent == tagsArray[i]) {
								$("#tags-goal-error-msg").html("You already have this tag!");
								return;
							}
						}
	
						//Finally lets check if the tag is too long
						if(tagContent.length > 15) {
							$("#tags-goal-error-msg").html("The tag can't be longer than 15 characters!");
							return;
						}
	
						//Now let's create the parent div
						var parentTag = document.createElement("div");
						parentTag.className = "actual_tag";
	
						//Creating the text to the parent div
						var tagTextDiv = document.createElement("p");
						tagTextDiv.innerHTML = "#" + tagContent;
	
						//Adding the tag to the "tagsArray"
						tagsArray.push(tagContent);
						console.log(tagsArray);
	
						//When the tag gets created we'll erase the input and remove the error message
						input.value = "";
						$("#tags-goal-error-msg").html("");
	
						//These two lines of code will append the tag's elements to the HTML document
						parentTag.appendChild(tagTextDiv);
						tagsParentContainer.appendChild(parentTag);
					}
				} else {
					input.value = "";
				}
			
			}
			//Checking if goal-input-tags has more characters than allowed
			if(charAmount > 100) {
				tagCharsCount.style.color = "red"; 
			}
		}
	});
});

//Looping through the checkboxes
checkBoxes.forEach(box => {
	box.addEventListener("click" , () => {
		selectOneCheckBox(box.id);
	});
});
for(var i = 0; i<checkBoxes.length; i++) {

}

function selectOneCheckBox(id) {
	for(var x = 1; x < checkBoxes.length+1; x++) {
		document.getElementById("box" + x).checked = false;
	}
	document.getElementById(id).checked = true;
}

//Adding an eventlistener to the createGoalButton
createGoalButton.addEventListener("click", () => {
	//Start gaining information and submitting to database
	//Since we've already validated all the tags, we only have two values to validate before submitting

	
});