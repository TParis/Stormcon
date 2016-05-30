<br>
<center>
<form action="?page=updates&action={action}&key={request_key}" method="post">
<div class="data_table" style="width: 500px;">
   <div class="data_row">
      <div class="column_data bold">First Name</div>
      <div class="column_data"><input class="edit2" type="text" name="contact-first-name" value="{contact_first_name}"></div>
   </div>
   <div class="data_row">
      <div class="column_data bold">Last Name</div>
      <div class="column_data"><input class="edit2" type="text" name="contact-last-name" value="{contact_last_name}"></div>
   </div>
   <div class="data_row">
      <div class="column_data bold">Company</div>
      <div class="column_data">{contact_company}</div>
   </div>
   <div class="data_row">
      <div class="column_data bold">Phone</div>
      <div class="column_data"><input class="edit2" type="text" name="contact-phone" value="{contact_phone}"></div>
   </div>
   <div class="data_row">
      <div class="column_data bold">Cell Phone</div>
      <div class="column_data"><input class="edit2" type="text" name="contact-cell-phone" value="{contact_cell_phone}"></div>
   </div>
   <div class="data_row">
      <div class="column_data bold">Email</div>
      <div class="column_data"><input class="edit2" type="text" name="contact-email" value="{contact_email}"></div>
   </div>
   <div class="data_row">
      <div class="column_data bold">Title</div>
      <div class="column_data"><input class="edit2" type="text" name="contact-title" value="{contact_title}"></div>
   </div>
   <div class="data_row">
      <div class="column_data bold">Division</div>
      <div class="column_data"><input class="edit2" type="text" name="contact-division" value="{contact_division}"></div>
   </div>
   <div class="data_row">
      <div class="column_data bold">EPA Number</div>
      <div class="column_data"><input class="edit2" type="text" name="contact-epa-number" value="{contact_epa_number}"></div>
   </div>
   <div class="data_row">
      <div class="column_data bold">ER Number</div>
      <div class="column_data"><input class="edit2" type="text" name="contact-er-number" value="{contact_er_number}"></div>
   </div>
   <div class="data_row">
      <div class="column_data bold">NOI Signer?</div>
      <div class="column_data"><input class="edit2" type="checkbox" name="contact-noi-signer" {contact_noi_signer}></div>
   </div>
</div>
<input class="submit-center" type="submit" value="Submit Contact">&nbsp;&nbsp;&nbsp;<input class="cancel" type="button" value="Cancel" onClick="window.history.back()">
</form>
