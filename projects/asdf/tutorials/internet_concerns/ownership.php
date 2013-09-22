<h1>Ownership</h1>
<p>
Every user in a UNIX system has a unique username. 
Users often correspond to a real world person, but can 
also be a type of system operation. Users can, and are, 
organized into groups. Each user has to belong to at 
least one group. Groups exist to give privileges or 
resources to only a certain group. For example, maybe 
users bob1234 and cba4321 are collaborating on a website. 
They would be included in the same group, projectsquirrel, 
because they might need access to some common project files.
</p>
<p>
Every file and directory on the UNIX system has an 
owner user and an owner group. So bob1234 could have 
these following relations with files on the system:
<object>
<ul>
	<li>Bob owns the file (he is the user who created it)</li>
	<li>Bob is a member of the group that owns the file (the file's owner group is projectsquirrel)</li>
	<li>Bob is neither the owner nor does he belong to the group that owns the file. bob1234 has no access to that file</li>
</ul>
</object>
</p>
&nbsp;<br />

