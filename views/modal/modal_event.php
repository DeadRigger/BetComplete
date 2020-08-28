<style>
    .rateinround {
      width: 2em;
      height: 2em;
      border: 2px solid orange;
      border-radius: 50%;
      line-height: 2em;
      text-align: center;
      color: white;
      margin-left: 5%;
      margin-right: 5%;
      overflow: hidden;
    }
    
    .calculation{
        margin-bottom: 15px;
        margin-top: 15px;
    }
    
    .img-team{
        margin-right: 10px;
        margin-left: 5%;
    }
</style>  

 <div class="modal fade" id="event-data" tabindex="-1" role="dialog" aria-hidden="true">
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
                  <img id="ev_icon_bet" width="70%" src="" style="margin-left: 15%" alt="">
              </div>
              <div class="row justify-content-center">
                  <span id="ev_time_bet"></span>
              </div>
              <div class="row justify-content-center">
                  <h5 id="ev_category_bet"></h5>
              </div>
              <div class="row justify-content-center align-items-center text-center">
                  <img class="img-team" width="60px" src="">
                  <h2 id="ev_team_bet"></h2>
                  <h2 id="ev_rate_bet" class="rateinround"></h2>
              </div>
              <div class="row align-items-center text-center">
                  <div class="col">
                      <? echo $lang['our_bet']; ?>
                      <input type="number" name="bet" min="1" max="100000" id="count_money_ev" placeholder="<? echo $lang['put']; ?>">
                      <a class="btn btn-outline-warning text-warning" onclick="plus('#count_money_ev', 5)">+5</a>
                      <a class="btn btn-outline-warning text-warning" onclick="plus('#count_money_ev', 10)">+10</a>
                      <a class="btn btn-outline-warning text-warning" onclick="plus('#count_money_ev', 20)">+20</a>
                      <a class="btn btn-outline-warning text-warning" onclick="plus('#count_money_ev', 50)">+50</a>
                      <a class="btn btn-outline-warning text-warning" onclick="plus('#count_money_ev', 100)">+100</a>
                  </div>
              </div>
              <div class="row calculation">
                  <div class="col-12 text-center">
                      <h4><? echo $lang['gain']; ?> <span id="count_ev">...</span>x<span id="rate_ev">...</span>=<span id="eval_ev">...</span></h4>
                  </div>
              </div>
              <div class="row">
                  <label class="col-12 text-center">
                      <a class="btn btn-success" id="make_bet_event"><h4><? echo $lang['bet']; ?></h4></a>
                  </label>
              </div>
              <input id="event_id" type="hidden">
              <input id="team_id" type="hidden">
          </div>
      </div>
    </div>
  </div>
</div>