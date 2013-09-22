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

	public class Results extends MovieClip
	{
		public var totalVotes:int;
		
		
		public function Results(resultList:XMLList)
		{
			//Create label that is the question
			var question:Label = new Label();
			question.text = resultList[0];
			question.autoSize = TextFieldAutoSize.LEFT;
			question.move(10, 30);
			addChild(question);
			
			//Count up votes
			for(var i:int = 1; i < resultList.children().length(); i++)
			{
				var tempInt:int = int(resultList[i].@votes);
				totalVotes += tempInt;
			}
			
			
			for(var j:int = 1; j < resultList.children().length(); j++)
			{
				//Create a label for each choice which displays the percentage before it
				var choice:Label = new Label();
				var votePercentage:String = String(int((resultList[j].@votes/totalVotes)*100));
				choice.text = votePercentage + "%" + "\t" + resultList[j];
				choice.autoSize = TextFieldAutoSize.LEFT;
				choice.move(10, ((35 * j) + 30));
				addChild(choice);
				
				//Add the emptyvotebar to the stage and save its width
				var emptyVotes:EmptyVoteBar = new EmptyVoteBar();
				var votesWidth:int = emptyVotes.width;
				emptyVotes.x = 10;
				emptyVotes.y = (35 * j) + 45;
				addChild(emptyVotes);
				
				//Find out what the width of the choice bar should be, move, and add it to the stage.
				var fullVotes:FullVoteBar = new FullVoteBar();
				var choiceWidth:int = (int(resultList[j].@votes) / totalVotes) * votesWidth;
				fullVotes.width = choiceWidth;
				fullVotes.x = 10;
				fullVotes.y = (35 * j) + 45;
				addChild(fullVotes);
				
				//Create a label to align to the right side.
				var numVotes:Label = new Label();
				numVotes.text = resultList[j].@votes;
				numVotes.autoSize = TextFieldAutoSize.RIGHT;
				numVotes.move((10 + votesWidth - numVotes.width),(35 * j) + 30);
				addChild(numVotes);
			}
			
			
		}
	}
}