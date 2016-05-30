<br>
<center>
<form action="?page=updates&action=submit-company-update&key={request_key}" method="post">
<div style="display: table";>
   <div style="display: table-row">
      <div id="contact" class="contact-update-table" style="display: table-cell">
         <div class="updaterequestsbox" style="display: table;">
            <div class="data_row">
               <div class="column_data"><h3>Company Information</h3></div>
               <div class="column_data"></div>
            </div>
            <div class="data_row">
               <div class="column_data bold" style="text-align: left;">Company Name</div>
               <div class="column_data">{company_name}</div>
            </div>
            <div class="data_row">
               <div class="column_data bold" style="text-align: left;">Company Legal Name</div>
               <div class="column_data"><input class="edit2" type="text" value="{company_legal_name}" name="company-legal-name"></div>
            </div>
            <div class="data_row">
               <div class="column_data bold" style="text-align: left;">Phone Number</div>
               <div class="column_data"><input class="edit2" type="text" value="{company_phone}" name="company-phone"></div>
            </div>
            <div class="data_row">
               <div class="column_data bold" style="text-align: left;">Fax Number</div>
               <div class="column_data"><input class="edit2" type="text" value="{company_fax}" name="company-fax"></div>
            </div>
            <div class="data_row">
               <div class="column_data bold" style="text-align: left;">Website URL</div>
               <div class="column_data"><input class="edit2" type="text" value="{company_url}" name="company-url"></div>
            </div>
            <div class="data_row">
               <div class="column_data bold" style="text-align: left;">Address Number</div>
               <div class="column_data"><input class="edit2" type="text" value="{company_address}" name="company-address"></div>
            </div>
            <div class="data_row">
               <div class="column_data bold" style="text-align: left;">Street</div>
               <div class="column_data"><input class="edit2" type="text" value="{company_street}" name="company-street"></div>
            </div>
            <div class="data_row">
               <div class="column_data bold" style="text-align: left;">City</div>
               <div class="column_data"><input class="edit2" type="text" value="{company_city}" name="company-city"></div>
            </div>
            <div class="data_row">
               <div class="column_data bold" style="text-align: left;">State</div>
               <div class="column_data"><input class="edit2" type="text" value="{company_state}" name="company-state"></div>
            </div>
            <div class="data_row">
               <div class="column_data bold" style="text-align: left;">Zip</div>
               <div class="column_data"><input class="edit2" type="text" value="{company_zip}" name="company-zip"></div>
            </div>
            <div class="data_row">
               <div class="column_data bold" style="text-align: left;">Number of Employees</div>
               <div class="column_data"><input class="edit2" type="text" value="{company_employees}" name="company-employees"></div>
            </div>
            <div class="data_row">
               <div class="column_data bold" style="text-align: left;">Type of Company</div>
               <div class="column_data"><input class="edit2" type="text" value="{company_type}" name="company-type"></div>
            </div>
            <div class="data_row">
               <div class="column_data bold" style="text-align: left;">Division</div>
               <div class="column_data"><input class="edit2" type="text" value="{company_division}" name="company-division"></div>
            </div>
            <div class="data_row">
               <div class="column_data bold" style="text-align: left;">State Tax ID</div>
               <div class="column_data"><input class="edit2" type="text" value="{company_state_tax}" name="company-state-tax"></div>
            </div>
            <div class="data_row">
               <div class="column_data bold" style="text-align: left;">Federal Tax ID</div>
               <div class="column_data"><input class="edit2" type="text" value="{company_fed_tax}" name="company-fed-tax"></div>
            </div>
            <div class="data_row">
               <div class="column_data bold" style="text-align: left;">SOS Number</div>
               <div class="column_data"><input class="edit2" type="text" value="{company_sos}" name="company-sos"></div>
            </div>
            <div class="data_row">
               <div class="column_data bold" style="text-align: left;">CN Number</div>
               <div class="column_data"><input class="edit2" type="text" value="{company_cn}" name="company-cn"></div>
            </div>
            <div class="data_row">
               <div class="column_data bold" style="text-align: left;">SIC Code</div>
               <div class="column_data"><input class="edit2" type="text" value="{company_sic}" name="company-sic"></div>
            </div>
         </div>
      </div>
      <div style="display: table-cell;">
         <div style="display: table; margin-left: 30px; clear: right;">
            <div style="display: table-row">
               <div class="updaterequestsbox" style="display: table-cell">
                  <div style="display: table; width: 600px;">
                     <div class="data_row">
                        <div class="column_data"><h3>Individual Contacts</h3></div>
                        <div class="column_data"></div>
                        <div class="column_data"></div>
                        <div class="column_data"><span class="add-new"><a href="?page=updates&action=new-contact&key={request_key}">Add New</a></span></div>
                     </div>
                     <div class="data_row">
                        <div class="column_data bold">Actions</div>
                        <div class="column_data bold">Name</div>
                        <div class="column_data bold">Phone</div>
                        <div class="column_data bold">Division</div>
                     </div>
                     {loop:contacts}
                     <div class="data_row">
                        <div class="column_data"><a href="?page=updates&action=edit-contact&id={contact_id}&key={request_key}"><img src="/images/edit.png"></a> <a href="?page=updates&action=delete-contact&id={contact_id}&key={request_key}"><img src="/images/delete.png"></a></div>
                        <div class="column_data">{contact_name}</div>
                        <div class="column_data">{contact_phone}</div>
                        <div class="column_data">{contact_division}</div>
                     </div>
                     {/loop:contacts}
                  </div>
               </div>
            </div>
            <div style="clear:both; height: 30px;">&nbsp;</div>
            <div style="display: table-row;">
               <div class="updaterequestsbox" style="display: table;  width: 600px;">
                     <div class="data_row">
                        <div class="column_data"><h3>Instructions</h3></div>
                     </div>
                     <div class="data_row">
                        <div class="column_data bold">
                           <p>Thank you for taking the time to complete this update.  This information will greatly assist us in building accurate Stormwater Pollution Protection Plans.<br /><br />
                           <p>First add, edit, or delete the individual points of contact.  You may lose information if you don't complete this step first.<br /><br />
                           <p>Please fill in your company information on the left hand side.  If you don't know what belongs in a field, feel free to leave it blank.<br /><br />
                           <p>When you have completed the updates, please click "Send Updates".  If you need help, please feel free to give us a call at (469) 742-8693.<br /><br />
                           <p><font color="#F00">IMPORTANT: </font> Do not submit this form until all contacts & updates have been made.  The key will be rendered invalid.
                        </div>
                     </div>
                     <div class="data_row">
                        <div class="column_data bold"><input class="update_requests" type="submit" value="Send Updates">&nbsp;&nbsp;&nbsp;<input class="update_requests" type="reset" value="Reset Form"></div>
                     </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</form>
</center>
