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

	public class PollList extends MovieClip
	{
		//Purpose: Given a list of topics, make a radio button for each.
		public var titleLabel:String = "Choose a topic you would like to vote on";
		public var selectedRB:RadioButton;
		
		public function PollList(topicList: XMLList):void
		{
			//trace("Poll List class");

			var rbg1:RadioButtonGroup = new RadioButtonGroup("group1");
			
			
			//Makes a label and adds it to the stage
			var pollTitle:Label = new Label();
			pollTitle.text = titleLabel;
			pollTitle.autoSize = TextFieldAutoSize.LEFT;
			pollTitle.move(20, 20);
			addChild(pollTitle);
			
			//Creates the radio buttons for the topics.
			for(var i:int = 0; i < topicList.length(); i++)
			{
				var tempVar:RadioButton = new RadioButton();
				tempVar.value = topicList[i].@category;
				tempVar.label = topicList[i].@category;
				tempVar.addEventListener(MouseEvent.CLICK, assignRB);
				tempVar.group = rbg1;
				tempVar.move(20, (30*i)+50);
				addChild(tempVar);
			}
		}
		public function assignRB(e:MouseEvent):void
		{
			var rb:RadioButton = e.target as RadioButton;
			selectedRB = rb;
		}
		
	}
}