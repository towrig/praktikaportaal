<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Võta meiega ühendust!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="./feedback.php" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">E-posti aadress</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="nimi@kirjaserver.ee">
                        <small id="emailHelp" class="form-text text-muted">Me ei jaga teie e-posti aadressi teistega vaid kasutame seda vaid teiega ühenduse võtmiseks.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Ole hea ja täpsusta oma soov</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>Tööpakkumine</option>
                            <option>Praktika leidmine</option>
                            <option>Soovin pakkuda teenust</option>
                            <option>Soovin infot</option>
                            <option>Muu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Sõnumi sisu</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary" style="width:100%;float:right;" formmethod="post" value="Saada" data-dismiss="modal">
                </form>
            </div>
        </div>
    </div>
</div>