<style>
    .textinround {
      width: auto;
      height: auto;
      max-width: 80px;
      max-height: 80px;
      border: 2px solid orange;
      border-radius: 50%;
      line-height: 2em;
      text-align: center;
      color: #100C3B;
      margin: 0 auto;
    }
    
    .calculation{
        margin-bottom: 15px;
        margin-top: 15px;
    }
</style> 

 <div class="modal fade" id="match-data" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-dark text-white">
      <div class="modal-body text-center">
          <div class="container">
              <div class="row justify-content-end">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" class="fa fa-angle-double-up  text-warning"></span>
                  </button>
              </div>
              <div class="row align-items-center">
                <div class="col-4 text-center">
                    <h5 class="text-warning team-left"></h5>
                    <img class="img-left" src="">
                </div>
                <div class="col-4 text-center">
                    <div id="info_match">
                        <p id="info_category"></p>
                        <b id="info_event"></b>
                    </div>
                    <h1 class="textinround"><b>VS</b></h1>
                    <div>
                        <p class="datetime-match" style="margin-bottom: 0"></p>
                        <p id="match_id"></p>
                    </div>
                </div>
                <div class="col-4 text-center">
                    <h5 class="text-warning team-right"></h5>
                    <img class="img-right" src="">
                </div>
              </div>
              <div class="row align-items-center btn-group-toggle" data-toggle="buttons">
                  <div class="col text-center">
                      <div class="btn btn-warning left-rate">
                          <input type="radio" name="rate" id="rate_l" autocomplete="off">
                      </div>
                  </div>
                  <div class="col text-center">

                  </div>
                  <div class="col text-center">
                      <div class="btn btn-warning right-rate">
                          <input type="radio" name="rate" id="rate_r" autocomplete="off">
                      </div>
                  </div>
              </div>
              <div class="row align-items-center text-center">
                  <div id="input-put" class="col">
                      <? echo $lang['our_bet']; ?>
                      <input type="number" name="bet" min="1" max="100000" id="count_money" placeholder="<? echo $lang['put']; ?>">
                      <a class="btn btn-outline-warning text-warning" onclick="plus('#count_money', 5)">+5</a>
                      <a class="btn btn-outline-warning text-warning" onclick="plus('#count_money', 10)">+10</a>
                      <a class="btn btn-outline-warning text-warning" onclick="plus('#count_money', 20)">+20</a>
                      <a class="btn btn-outline-warning text-warning" onclick="plus('#count_money', 50)">+50</a>
                      <a class="btn btn-outline-warning text-warning" onclick="plus('#count_money', 100)">+100</a>

                  </div>
              </div>
              <div class="row calculation">
                  <div class="col-12 text-center">
                      <h4><? echo $lang['gain']; ?> <span id="count">...</span>x<span id="rate">...</span>=<span id="eval">...</span></h4>
                  </div>
              </div>
              <div class="row">
                  <label class="col-12 text-center">
                      <a class="btn btn-success col-4" id="make_bet"><h4><? echo $lang['bet']; ?></h4></a>
                  </label>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>