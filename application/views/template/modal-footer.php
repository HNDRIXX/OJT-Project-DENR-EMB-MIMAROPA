
<div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">&nbsp;&nbsp;Edit Blocking<br><h5 id="name-content" style="margin-top:1px;"></h5></h4>
            </div>
            <div class="modal-body">
              <?= form_open(base_url('Pages/editblock'));?>
                <input type="hidden" name="id" id="id-content" readonly><input type="hidden" name="name" id="nameinput-content"><br>

                <div id="pismublock">
                  <img id="pismuedit" src="https://i.ibb.co/YB7KVTK/pismu.jpg" alt="" draggable="false"><br>
                    <i style="position:absolute;top:1.5%;right:0;left:0;font-size:12px;"><b>Planning and Information Systems and Management</b></i>
                    <input id="pismuradio1" title="PISMU" placeholder="PISMU" type="radio" name="block" value="pismublock1" required>
                    <input id="pismuradio2" title="PISMU" placeholder="PISMU" type="radio" name="block" value="pismublock2" required>
                    <input id="pismuradio3" title="PISMU" placeholder="PISMU" type="radio" name="block" value="pismublock3" required>
                    <input id="pismuradio4" title="PISMU" placeholder="PISMU" type="radio" name="block" value="pismublock4" required>
                    <input id="pismuradio5" title="PISMU" placeholder="PISMU" type="radio" name="block" value="pismublock5" required>
                    <input id="pismuradio6" title="PISMU" placeholder="PISMU" type="radio" name="block" value="pismublock6" required>
                    <input id="pismuradio7" title="PISMU" placeholder="PISMU" type="radio" name="block" value="pismublock7" required>
                    <input id="pismuradio8" title="PISMU" placeholder="PISMU" type="radio" name="block" value="pismublock8" required>
                    <input id="pismuradio9" title="PISMU" placeholder="PISMU" type="radio" name="block" value="pismublock9" required>      
                  <i id="pismuleft" class="fa-solid fa-circle-chevron-left"></i>
                </div>

                <div id="recordsblock">
                  <img id="recordsedit" src="https://i.ibb.co/d5GsXML/records.jpg" alt="" draggable="false"><br>
                  <i style="position:absolute;top:1.5%;right:0;left:0;font-size:13px;"><b>Records</b></i>
                    <input id="recordsradio1" title="Records" placeholder="Records" type="radio" name="block" value="rcrdsblock1" required>
                    <input id="recordsradio2" title="Records" placeholder="Records" type="radio" name="block" value="rcrdsblock2" required>
                    <input id="recordsradio3" title="Records" placeholder="Records" type="radio" name="block" value="rcrdsblock3" required>
                    <input id="recordsradio4" title="Records" placeholder="Records" type="radio" name="block" value="rcrdsblock4" required>
                    <input id="recordsradio5" title="Records" placeholder="Records" type="radio" name="block" value="rcrdsblock5" required>
                    <input id="recordsradio6" title="Records" placeholder="Records" type="radio" name="block" value="rcrdsblock6" required>
                    <input id="recordsradio7" title="Records" placeholder="Records" type="radio" name="block" value="rcrdsblock7" required>
                  <i id="recordsleft" class="fa-solid fa-circle-chevron-left"></i>
                  <i id="recordsright" class="fa-solid fa-circle-chevron-right"></i>
                </div>

                <div id="technicalblock" style="margin-bottom:38px;">
                  <img id="technicaledit" src="https://i.ibb.co/g4Q3nf8/technical.jpg" alt="" draggable="false"><br>
                  <i style="position:absolute;top:1.5%;right:0;left:0;font-size:12px;"><b>Technical and Legal</b></i>
                    <input id="eswmradio1" title="ESWM" placeholder="ESWM" type="radio" name="block" value="eswmblock1" required>
                    <input id="eswmradio2" title="ESWM" placeholder="ESWM" type="radio" name="block" value="eswmblock2" required>
                    <input id="eswmradio3" title="ESWM" placeholder="ESWM" type="radio" name="block" value="eswmblock3" required>
                    <input id="eswmradio4" title="ESWM" placeholder="ESWM" type="radio" name="block" value="eswmblock4" required>
                    <input id="emedradio1" title="ESWM" placeholder="ESWM" type="radio" name="block" value="emedblock1" required>
                    <input id="emedradio2" title="ESWM" placeholder="ESWM" type="radio" name="block" value="emedblock2" required>
                    <input id="emedradio3" title="ESWM" placeholder="ESWM" type="radio" name="block" value="emedblock3" required>
                    <input id="emedradio4" title="ESWM" placeholder="ESWM" type="radio" name="block" value="emedblock4" required>
                    <input id="emedradio5" title="ESWM" placeholder="ESWM" type="radio" name="block" value="emedblock5" required>
                    <input id="emedradio6" title="ESWM" placeholder="ESWM" type="radio" name="block" value="emedblock6" required>
                    <input id="emedradio7" title="ESWM" placeholder="ESWM" type="radio" name="block" value="emedblock7" required>
                    <input id="emedradio8" title="ESWM" placeholder="ESWM" type="radio" name="block" value="emedblock8" required>
                    <input id="emedradio9" title="ESWM" placeholder="ESWM" type="radio" name="block" value="emedblock9" required>
                    <input id="emedradio10" title="ESWM" placeholder="ESWM" type="radio" name="block" value="emedblock10" required>
                    <input id="emedradio11" title="ESWM" placeholder="ESWM" type="radio" name="block" value="emedblock11" required>
                    <input id="emedradio12" title="ESWM" placeholder="ESWM" type="radio" name="block" value="emedblock12" required>
                    <input id="emedradio13" title="ESWM" placeholder="ESWM" type="radio" name="block" value="emedblock13" required>
                    <input id="emedradio14" title="ESWM" placeholder="ESWM" type="radio" name="block" value="emedblock14" required>
                    <input id="cpdradio2" title="CPD" placeholder="CPD" type="radio" name="block" value="cpdblock2" required>
                    <input id="cpdradio3" title="CPD" placeholder="CPD" type="radio" name="block" value="cpdblock3" required>
                    <input id="cpdradio4" title="CPD" placeholder="CPD" type="radio" name="block" value="cpdblock4" required>
                    <input id="cpdradio5" title="CPD" placeholder="CPD" type="radio" name="block" value="cpdblock5" required>
                    <input id="cpdradio6" title="CPD" placeholder="CPD" type="radio" name="block" value="cpdblock6" required>
                    <input id="cpdradio7" title="CPD" placeholder="CPD" type="radio" name="block" value="cpdblock7" required>
                    <input id="cpdradio8" title="CPD" placeholder="CPD" type="radio" name="block" value="cpdblock" required>
                    <input id="cpdradio9" title="CPD" placeholder="CPD" type="radio" name="block" value="cpdblock9" required>
                    <input id="cpdradio10" title="CPD" placeholder="CPD" type="radio" name="block" value="cpdblock10" required>
                    <input id="cpdradio11" title="CPD" placeholder="CPD" type="radio" name="block" value="cpdblock11" required>
                    <input id="cpdradio12" title="CPD" placeholder="CPD" type="radio" name="block" value="cpdblock12" required>
                    <input id="cpdradio13" title="CPD" placeholder="CPD" type="radio" name="block" value="cpdblock13" required>
                    <input id="cpdradio14" title="CPD" placeholder="CPD" type="radio" name="block" value="cpdblock14" required>
                    <input id="cpdradio15" title="CPD" placeholder="CPD" type="radio" name="block" value="cpdblock15" required>
                    <input id="cpdradio16" title="CPD" placeholder="CPD" type="radio" name="block" value="cpdblock16" required>
                    <input id="cpdradio17" title="CPD" placeholder="CPD" type="radio" name="block" value="cpdblock17" required>
                    <input id="cpdradio18" title="CPD" placeholder="CPD" type="radio" name="block" value="cpdblock18" required>
                    <input id="lglradio1" title="Legal" placeholder="Legal" type="radio" name="block" value="lglblock1" required>
                    <input id="lglradio2" title="Legal" placeholder="Legal" type="radio" name="block" value="lglblock2" required>
                    <input id="lglradio3" title="Legal" placeholder="Legal" type="radio" name="block" value="lglblock3" required>
                    <input id="lglradio4" title="Legal" placeholder="Legal" type="radio" name="block" value="lglblock4" required>
                  <i id="technicalleft" class="fa-solid fa-circle-chevron-left"></i>
                  <i id="technicalright" class="fa-solid fa-circle-chevron-right"></i>
                </div>

                <div id="fadblock">
                  <img id="fadedit" src="https://i.ibb.co/CQmTgsK/fad.jpg" alt="" draggable="false"><br>
                  <i style="position:absolute;top:1.5%;right:0;left:0;font-size:12px;"><b>Finance and Administrative Division</b></i>
                    <input id="fadradio1" title="FAD" placeholder="FAD" type="radio" name="block" value="fadblock1" required>
                    <input id="fadradio2" title="FAD" placeholder="FAD" type="radio" name="block" value="fadblock2" required>
                    <input id="fadradio3" title="FAD" placeholder="FAD" type="radio" name="block" value="fadblock3" required>
                    <input id="fadradio4" title="FAD" placeholder="FAD" type="radio" name="block" value="fadblock4" required>
                    <input id="fadradio5" title="FAD" placeholder="FAD" type="radio" name="block" value="fadblock5" required>
                    <input id="fadradio6" title="FAD" placeholder="FAD" type="radio" name="block" value="fadblock6" required>
                    <input id="fadradio7" title="FAD" placeholder="FAD" type="radio" name="block" value="fadblock7" required>
                    <input id="fadradio8" title="FAD" placeholder="FAD" type="radio" name="block" value="fadblock8" required>
                    <input id="fadradio9" title="FAD" placeholder="FAD" type="radio" name="block" value="fadblock9" required>
                    <input id="fadradio10" title="FAD" placeholder="FAD" type="radio" name="block" value="fadblock10" required>
                    <input id="fadradio11" title="FAD" placeholder="FAD" type="radio" name="block" value="fadblock11" required>
                    <input id="fadradio12" title="FAD" placeholder="FAD" type="radio" name="block" value="fadblock12" required>
                  <i id="fadleft" class="fa-solid fa-circle-chevron-left"></i>
                  <i id="fadright" class="fa-solid fa-circle-chevron-right"></i>
                </div>

                <div id="ordblock" style="margin-bottom:75px;">
                  <img id="ordedit" src="https://i.ibb.co/0GcHHrm/ord.jpg" alt="" draggable="false"><br>
                  <i style="position:absolute;top:1.5%;right:0;left:0;font-size:12px;"><b>Office of the Regional Director</b></i>
                    <input id="ordradio1" title="ORD" placeholder="ORD" type="radio" name="block" value="ordblock1" required>
                    <input id="ordradio2" title="ORD" placeholder="ORD" type="radio" name="block" value="ordblock2" required>
                    <input id="ordradio3" title="ORD" placeholder="ORD" type="radio" name="block" value="ordblock3" required>
                  <i id="ordright" class="fa-solid fa-circle-chevron-right"></i>
                </div>
                <br><button type="submit" name="submit" id="submitblock">SUBMIT</button>
              <?= 
              form_close();
            ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="assets/js/floorplan.js"></script>
</body>
</html>