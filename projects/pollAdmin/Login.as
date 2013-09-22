package
{
	import flash.display.*;
	import flash.events.*;
	import flash.text.*;// to display text
	import flash.net.*;// for network operations
	import fl.controls.Button;
	import fl.controls.Label;
	import fl.controls.TextInput;
	import fl.controls.RadioButton;
	import fl.controls.RadioButtonGroup;
	
	public class Login extends MovieClip
	{
		//Instance Variables
		public var userLabel:Label;
		public var username:TextInput;
		public var passLabel:Label;
		public var thePassword:TextInput;
		
		public function Login()
		{
			userLabel = new Label();
			userLabel.text = "Username: ";
			userLabel.width = 200;
			userLabel.move(20, 100);
			addChild(userLabel);
			
			username = new TextInput();
			username.x = 80;
			username.y = 100;
			addChild(username);
			
			passLabel = new Label();
			passLabel.text = "Password: ";
			passLabel.width = 200;
			passLabel.move(20, 70);
			addChild(passLabel);
			
			thePassword = new TextInput();
			thePassword.x = 80;
			thePassword.y = 70;
			addChild(thePassword);
			
		}
		
	}
}