package
{
	import flash.display.*;
	import flash.events.*;
	import flash.text.*;
	import flash.net.*;
	import fl.controls.Button;
	import fl.controls.Label;
	import fl.controls.RadioButton;
	import fl.controls.RadioButtonGroup;
	
	public class myAdmin extends MovieClip
	{
		//Instance Variables
		private var myLoader:URLLoader;
		private var myURL:String = "http://www.glencheney.com/projects/pollAdmin/admin.php";
		private var myLogin:Login;
		private var submit:Button;
		private var loginLabel:Label;
		private var aT:Button;
		private var aQ:Button;
		private var myTitle:Label;
		private var myTopics:addTopic;
		private var myQuestions:addQuestion;
		private var submitTopic:Button;
		private var submitQuestion:Button;
		
		public function myAdmin()
		{
			myLogin = new Login();
			addChild(myLogin);
			
			loginLabel = new Label();
			loginLabel.text = "Please log in with your username and password";
			loginLabel.width = 300;
			loginLabel.move(20, 30);
			addChild(loginLabel);
			
			submit = new Button()
			submit.label = "Submit";
			submit.width = 100;
			submit.move(80, 125);
			addChild(submit);
			submit.addEventListener(MouseEvent.CLICK, login);
		}
		public function login(e:MouseEvent)
		{
			if(myLogin.username.text != "" && myLogin.thePassword.text != "")
			{
				trace(myURL + "?state=login&username=" + myLogin.username.text + "&password=" + myLogin.thePassword.text);
				var myRequest:URLRequest = new URLRequest(myURL + "?state=login&username=" + myLogin.username.text + "&password=" + myLogin.thePassword.text);
				myLoader = new URLLoader();
				myLoader.load(myRequest);
				myLoader.addEventListener(Event.COMPLETE, loginComplete);
			}
		}
		public function loginComplete(e:Event):void
		{
			trace(myLoader.data);
			if(myLoader.data == "false")
			{
				//Bad login info
				loginLabel.text = "Please try again";
			}
			else
			{
				//Correct login
				removeChild(myLogin);
				removeChild(loginLabel);
				removeChild(submit);
				
				//Options for the user to add a question or topic
				myTitle = new Label();
				myTitle.text = "Choose something Mr. Admin";
				myTitle.width = 200;
				myTitle.move(180, 30);
				addChild(myTitle);
				
				aT = new Button();
				aQ = new Button();
				aT.label = "Add Topic";
				aQ.label = "Add Question";
				aT.width = 100;
				aQ.width = 100;
				aT.move(200, 50);
				aQ.move(200, 80);
				addChild(aT);
				addChild(aQ);
				aT.addEventListener(MouseEvent.CLICK, AddTopic);
				aQ.addEventListener(MouseEvent.CLICK, AddQuestion);
			}
		}
		public function AddTopic(e:MouseEvent)
		{
			//Remove stuff
			removeChild(aT);
			removeChild(aQ);
			removeChild(myTitle);
			myTopics = new addTopic();
			addChild(myTopics);
			
			//Add submit button
			submitTopic = new Button()
			submitTopic.label = "Submit";
			submitTopic.width = 100;
			submitTopic.move(100, 230);
			addChild(submitTopic);
			submitTopic.addEventListener(MouseEvent.CLICK, TopicPart2);
		}
		public function TopicPart2(e:MouseEvent)
		{
			trace(myURL + "?state=addtopic&newtopic=" + myTopics.newTopic.text + "&newquestion="+ myTopics.newQuestion.text + "&choice1=" + myTopics.choice1.text + "&choice2=" + myTopics.choice2.text + "&choice3=" + myTopics.choice3.text + "&choice4=" + myTopics.choice4.text);
			var myRequest:URLRequest = new URLRequest(myURL + "?state=addtopic&newtopic=" + myTopics.newTopic.text + "&newquestion="+ myTopics.newQuestion.text + "&choice1=" + myTopics.choice1.text + "&choice2=" + myTopics.choice2.text + "&choice3=" + myTopics.choice3.text + "&choice4=" + myTopics.choice4.text);
			myLoader = new URLLoader();
			myLoader.load(myRequest);
			myLoader.addEventListener(Event.COMPLETE, topicAdded);
		}
		public function topicAdded(e:Event)
		{
			//The topic, question, and choices have been added to the db
			//Back to main
			if(myLoader.data == "true")
			{
				removeChild(myTopics);
				removeChild(submitTopic);
				addChild(aT);
				addChild(aQ);
				addChild(myTitle);
				myTitle.text = "Success!";
			}
			else if(myLoader.data == "false")
			{
				myTopics.titleLabel.text = "***You didn't fill in all the necessary fields***";
			}
		}
		
		public function AddQuestion(e:MouseEvent)
		{
			//Remove stuff
			removeChild(aT);
			removeChild(aQ);
			removeChild(myTitle);
			myQuestions = new addQuestion();
			addChild(myQuestions);
			
			//Add submit button
			submitQuestion = new Button()
			submitQuestion.label = "Submit";
			submitQuestion.width = 100;
			submitQuestion.move(100, 230);
			addChild(submitQuestion);
			submitQuestion.addEventListener(MouseEvent.CLICK, QuestionPart2);
		}
		public function QuestionPart2(e:MouseEvent)
		{
			trace(myURL + "?state=addquestion&topic=" + myQuestions.newTopic.text + "&newquestion="+ myQuestions.newQuestion.text + "&choice1=" + myQuestions.choice1.text + "&choice2=" + myQuestions.choice2.text + "&choice3=" + myQuestions.choice3.text + "&choice4=" + myQuestions.choice4.text);
			var myRequest:URLRequest = new URLRequest(myURL + "?state=addquestion&topic=" + myQuestions.newTopic.text + "&newquestion="+ myQuestions.newQuestion.text + "&choice1=" + myQuestions.choice1.text + "&choice2=" + myQuestions.choice2.text + "&choice3=" + myQuestions.choice3.text + "&choice4=" + myQuestions.choice4.text);
			myLoader = new URLLoader();
			myLoader.load(myRequest);
			myLoader.addEventListener(Event.COMPLETE, questionAdded);
		}
		public function questionAdded(e:Event)
		{
			//Back to main
			trace(myLoader.data);
			if(myLoader.data == "true")
			{
				removeChild(myQuestions);
				removeChild(submitQuestion);
				addChild(aT);
				addChild(aQ);
				addChild(myTitle);
				myTitle.text = "Success!";
			}
			else if(myLoader.data == "false")
			{
				myQuestions.titleLabel.text = "***You didn't fill in all the necessary fields***";
			}
		}
	}
}