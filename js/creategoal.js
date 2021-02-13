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
var repeatValue;

var tooLongHeader = false;
var tooLongContent = false;

//Declaring variable of character amount in header input
goalInputs.forEach(input => {

	input.addEventListener("input", (event) => {
		writeInput(event);
	});

	input.addEventListener("keydown", (event) => {
		writeInput(event);
	});

	charAmount = 0;

	function writeInput(e) {
		
		charAmount = input.value.length;

		//Setting the HTML elements value to match "headerCharAmount"
		//Also I added a "/20" at the end to show how many characters you can write
		if(input.id == "header-input") {
			headerCharsCount.innerHTML = charAmount + "/20";
			//Checking if header-input has more characters than allowed
			if(charAmount > 20) {
				headerCharsCount.style.color = "red";
				tooLongHeader = true;
			} else {
				headerCharsCount.style.color = "black";
				tooLongHeader = false;
			}
		} else if(input.id == "content-textarea") {
			contentCharsCount.innerHTML = charAmount + "/500";
			//Checking if content-textarea has more characters than allowed
			if(charAmount > 500) {
				contentCharsCount.style.color = "red";
				tooLongContent = true;
			} else {
				contentCharsCount.style.color = "black";
				tooLongContent = false;
			}
		} else {
			//We know that user is typing in the "tags input" since everything else has been checked
			//If the user hits either space or enter, that will create a tag
			//Let's check if the user hits either one of those keys
			if(e.which == 13 || e.which == 32) {
				//Checking if there is any value and that the value cannot be a blankspace
				if(input.value && !input.value.includes(" ")) {
					if(tagsArray.length <= 4) {

						tagCharsCount.innerHTML = tagsArray.length + 1 + "/5";
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
					$("#tags-goal-error-msg").html("You already have five tags!");
					input.value = "";
					return;
				}
			
			}
		}
	}
});

//Looping through the checkboxes
checkBoxes.forEach(box => {
	box.addEventListener("click" , () => {
		selectOneCheckBox(box.id);
		repeatValue = box.getAttribute("name");
		console.log(repeatValue);
	});
});

function selectOneCheckBox(id) {
	for(var x = 1; x < checkBoxes.length+1; x++) {
		document.getElementById("box" + x).checked = false;
	}
	document.getElementById(id).checked = true;
}


//Adding an eventlistener to the createGoalButton
createGoalButton.addEventListener("click", () => {
	$("#submit-goal-error").html("");
	console.log("clicked");
	//Start gaining information and submitting to database
	//Since we've already validated all the tags, we only have two values to validate before submitting
	var characters = /^.*?(?=[\^%#&$\*:<>\?/\{\|\}]).*$/;
	var headerContent = headerText.value;
	var contentContent = contentText.value;

	//Lets start by checking for invalid characters
	if(headerContent && headerContent !== " ") {
		if(contentContent && contentContent !== " ") {
			console.log("value is good");

			if(characters.test(headerContent) || characters.test(contentContent)) {
				$("#submit-goal-error").html("Please remove the invalid characters!");
				return;
			}

			if(tooLongContent || tooLongHeader) {
				$("#submit-goal-error").html("Too long title or content!");
				return;
			}

			if(repeatValue == "" || repeatValue == null || repeatValue == " ") {
				$("#submit-goal-error").html("Make sure to specify a 'repeat' value!");
				return;
			}

			if(tagsArray.length == 0) {
				$("#submit-goal-error").html("Please create at least one tag!");
				return;
			}

			$("#submit-goal-error").html("");
			//Joining all the tagsArray objects by a dot
			var allTags = tagsArray.join(".");
			//Let's begin submitting to "includes/goal.php"
			$(document).ready(function() {
				$.ajax({
					type: "POST",
					url: "includes/goal.php",
					data: {header: headerContent, content: contentContent, tags: allTags, repeat: repeatValue},
					success: function() {
						$("#submit-goal-error").css("color", "green");
						$("#submit-goal-error").html("Successfully set goal!");

						//Resetting variables and inputs to original state
						headerText.value = "";
						contentText.value = "";
						tagsArray = [];
					},
					error: function() {
						$("#submit-goal-error").html("Error setting goal");
					}
				});
			});	


		} else {
			$("#submit-goal-error").html("A field cannot be left empty!");
			return;
		}
	} else {
		$("#submit-goal-error").html("A field cannot be left empty!");
		return;
	}
});