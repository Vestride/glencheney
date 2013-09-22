package 
{
	import flash.display.*;
	import flash.events.*;
	import flash.text.*;// to display text
	import flash.net.*;// for network operations
	import fl.controls.Button;
	import fl.controls.Label;
	import fl.controls.RadioButton;
	import fl.controls.RadioButtonGroup;

	public class Polls extends MovieClip
	{
		private var myURL:String = "http://www.glencheney.com/poll/poll.php";
		private var myLoader:URLLoader;// object that can load external text data
		private var myTopics:XML;// our xml topics 
		private var myQuestion:XML;// our xml question 
		private var myResults:XML; // our xml results
		private var pList:PollList; //PollList object
		private var poll:Poll; // Poll object
		private var theResults:Results; //results object
		public var submit:Button; //Submit button.
		private var currentTopic:String; //Keep track of the poll we're on.
		private var viewR:Button; //View Results button
		private var strtOvr:Button; //Start over button
		private var resultsThere:Boolean = false; //The result object is on the stage
		private var questionThere:Boolean = false; //The question object is on the stage

		public function Polls()
		{
			//Create a request for the topics
			var myRequest:URLRequest = new URLRequest(myURL + "?state=start");
			myLoader = new URLLoader();
			myLoader.load(myRequest);
			myLoader.addEventListener(Event.COMPLETE,loadCompleted);
			
			
		}
		private function loadCompleted(e:Event):void
		{
			//If the results are on the stage already
			if(resultsThere)
			{
				removeChild(theResults);
				removeChild(strtOvr);
				resultsThere = false;
			}
			if(questionThere)
			{
				removeChild(poll);
				removeChild(submit);
				removeChild(viewR);
				removeChild(strtOvr);
				questionThere = false;
			}
			
			//Adds a topics(polllist) object to the stage
			myTopics = new XML(myLoader.data);
			pList = new PollList(myTopics.children());
			addChild(pList);
			
			//Makes a submit button
			submit = new Button();
			submit.label = "Submit";
			submit.width = 80;
			submit.move(20, ((myTopics.children().length() * 30) + 50));
			addChild(submit);
			submit.addEventListener(MouseEvent.CLICK, getSpecificPoll);
			
		}
		public function getSpecificPoll(e:MouseEvent):void
		{
			//trace("Get the " + pList.selectedRB.value + " poll");
			currentTopic = pList.selectedRB.label;
			
			//Makes a request for the specific poll
			var myRequest:URLRequest = new URLRequest(myURL + "?state=poll&poll=" + pList.selectedRB.value);
			myLoader = new URLLoader();
			myLoader.load(myRequest);
			myLoader.addEventListener(Event.COMPLETE, pollChosen);
		}
		public function pollChosen(e:Event)
		{
			//Creates a new question object
			myQuestion = new XML(myLoader.data);
			poll = new Poll(myQuestion.children());
			
			//Removes the old topic object and event listener for the submit button
			removeChild(pList);
			submit.removeEventListener(MouseEvent.CLICK, getSpecificPoll);
			removeChild(submit);
			
			//Adds the new question object
			addChild(poll);
			questionThere = true;
			
			//Adds the submit button
			submit.move(20, (((myQuestion.children().length()-1) * 30) + 50));
			addChild(submit);
			submit.addEventListener(MouseEvent.CLICK, vote);
			
			//Adds the view results button
			viewR = new Button();
			viewR.label = "View Results";
			viewR.width = 80;
			viewR.move(120, (((myQuestion.children().length()-1) * 30) + 50));
			addChild(viewR);
			viewR.addEventListener(MouseEvent.CLICK, skipVote);
			
			//Adds the start over button
			strtOvr = new Button();
			strtOvr.label = "Start Over";
			strtOvr.width = 80;
			strtOvr.move(220, (((myQuestion.children().length()-1) * 30) + 50));
			addChild(strtOvr);
			strtOvr.addEventListener(MouseEvent.CLICK, startOver);
		}
		public function vote(e:Event)
		{			
			//Creates a request to vote for the selected poll
			var myRequest:URLRequest = new URLRequest(myURL + "?state=vote&poll=" + currentTopic + "&choice=" + poll.selectedRB.value);
			myLoader = new URLLoader();
			myLoader.load(myRequest);
			myLoader.addEventListener(Event.COMPLETE, viewResults);
		}
		public function skipVote(e:MouseEvent)
		{
			//Creates a request to view the results without voting
			var myRequest:URLRequest = new URLRequest(myURL + "?state=results&poll=" + currentTopic);
			myLoader = new URLLoader();
			myLoader.load(myRequest);
			myLoader.addEventListener(Event.COMPLETE, viewResults);
		}
		public function viewResults(e:Event)
		{
			//Remove old objects
			removeChild(poll);
			questionThere = false;
			submit.removeEventListener(MouseEvent.CLICK, vote);
			removeChild(submit);
			viewR.removeEventListener(MouseEvent.CLICK, skipVote);
			removeChild(viewR);
			strtOvr.removeEventListener(MouseEvent.CLICK, startOver);
			removeChild(strtOvr);
			
			//add results object
			myResults = new XML(myLoader.data);
			theResults = new Results(myResults.children());
			addChild(theResults);
			resultsThere = true;
			
			//Add start over button
			strtOvr.label = "Start Over";
			strtOvr.move(10, (((myResults.children().length()-1) * 35) + 70));
			addChild(strtOvr);
			strtOvr.addEventListener(MouseEvent.CLICK, startOver);
		}
		public function startOver(e:MouseEvent)
		{
			//Create a request for the topics
			var myRequest:URLRequest = new URLRequest(myURL + "?state=start");
			myLoader = new URLLoader();
			myLoader.load(myRequest);
			myLoader.addEventListener(Event.COMPLETE,loadCompleted);
		}
	}
}