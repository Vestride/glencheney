package 
{
	import flash.display.*;
	import flash.events.*;
	import flash.net.*;
	import fl.controls.RadioButton;
	import fl.controls.RadioButtonGroup;
	import flash.text.TextField;
	import flash.text.TextFieldAutoSize;
	import fl.controls.Label;
	import fl.controls.Button;

	public class Poll extends MovieClip
	{
		public var selectedRB:RadioButton;
		
		public function Poll(questionList:XMLList)
		{
			
			var rbg1:RadioButtonGroup = new RadioButtonGroup("group1");
			
			
			//Makes a label and adds it to the stage
			var question:Label = new Label();
			question.text = questionList[0];
			question.autoSize = TextFieldAutoSize.LEFT;
			question.move(20, 20);
			addChild(question);
			
			//Creates the radio buttons for the topics.
			for(var i:int = 1; i < questionList.length(); i++)
			{
				var tempVar:RadioButton = new RadioButton();
				tempVar.value = i; //Could make the value questionList[i]
				tempVar.label = questionList[i];
				tempVar.width = 300;
				tempVar.addEventListener(MouseEvent.CLICK, assignRB);
				tempVar.group = rbg1;
				tempVar.move(20, (30*(i-1))+50);
				addChild(tempVar);
			}
		}
		public function assignRB(e:MouseEvent)
		{
			var rb:RadioButton = e.target as RadioButton;
			selectedRB = rb;
		}
	}
	
}