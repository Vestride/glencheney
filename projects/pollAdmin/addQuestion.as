package
{
	import flash.display.*;
	import flash.events.*;
	import flash.text.*;
	import flash.net.*;
	import fl.controls.Button;
	import fl.controls.Label;
	import fl.controls.TextInput;
	
	public class addQuestion extends MovieClip
	{
		public var titleLabel:Label;
		public var newTopic:TextInput;
		public var newQuestion:TextInput;
		public var choice1:TextInput;
		public var choice2:TextInput;
		public var choice3:TextInput;
		public var choice4:TextInput;
		
		public function addQuestion()
		{
			//Title label
			titleLabel = new Label();
			titleLabel.text = "Choose a unique question to add to the database";
			titleLabel.move(20, 20);
			titleLabel.width = 300;
			addChild(titleLabel);
			
			//Label for new topic
			var newTopicLabel:Label = new Label();
			newTopicLabel.text = "Existing topic: ";
			newTopicLabel.move(20, 50);
			addChild(newTopicLabel);
			
			//Textbox for new question
			newTopic = new TextInput();
			newTopic.move(100, 50);
			addChild(newTopic);
			
			//Label for new question
			var newQuestionLabel:Label = new Label();
			newQuestionLabel.text = "New Question: ";
			newQuestionLabel.move(20, 80);
			addChild(newQuestionLabel);
			
			//Textbox for new question
			newQuestion = new TextInput();
			newQuestion.move(100, 80);
			addChild(newQuestion);
			
			//Label for choices
			var choiceLabel:Label = new Label();
			choiceLabel.text = "Choices: ";
			choiceLabel.move(20, 110);
			addChild(choiceLabel);
			
			//Textbox for choice1
			choice1 = new TextInput();
			choice1.move(100, 110);
			addChild(choice1);
			
			//Textbox for choice2
			choice2 = new TextInput();
			choice2.move(100, 140);
			addChild(choice2);
			
			//Textbox for choice3
			choice3 = new TextInput();
			choice3.move(100, 170);
			addChild(choice3);
			
			//Textbox for choice4
			choice4 = new TextInput();
			choice4.move(100, 200);
			addChild(choice4);
		}
	}
}