<!DOCTYPE html>
<!-- saved from url=(0050)https://www.provablyfair.me/casino/stake-verifier/ -->
<html lang="en-US" style="transform: none;">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" id="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <!-- This site is optimized with the Yoast SEO plugin v15.8 - https://yoast.com/wordpress/plugins/seo/ -->
    <title>Stake - Provably Fair Bet Verifier</title>
</head>

<body>
    <!-- Mobile Menu End -->
    <!-- Back to Top Start -->
    <!-- Jquery js-->
    <script src="{{ mix('/js/jquery-3.4.1.min.js') }}"></script>
    @include('stake.mines-js')
    <script>
        const serverSeed = 'VyyZRiee7R42jxmvj7oSR';
        const clientSeed = '1';
        var nonce = 0;
        const mines = 4;

        function checkMines(mines) {
            var verify = true;
            var i = 0;
            nonce = 0;

            while (verify) {
                var minesVerify = generateMines();
                minesVerify = minesVerify.sort(function compare(a, b) {
                    if (a < b) return -1;
                    if (a > b) return 1;
                    return 0;
                });

                mines = mines.sort(function compare(a, b) {
                    if (a < b) return -1;
                    if (a > b) return 1;
                    return 0;
                });

                for (let index = 0; index < mines.length; index++) {
                    if (JSON.stringify(mines) === JSON.stringify(minesVerify)) {
                        verify = false;
                    } else {
                        verify = true
                    }
                }
                nonce++;
            }

            minesVerify = generateMines();

            return minesVerify;
        }

        function generateMines() {
            var rounds = globExecCalMines.verify({
                serverSeed: serverSeed,
                clientSeed: clientSeed,
                nonce: nonce
            }).slice(0, mines);

            for (let index = 0; index < rounds.length; index++) {
                rounds[index] = rounds[index] - 1;
            }

            return rounds;
        }

        function setPlays(plays) {
            $.ajax({
                url: '{{Route("setPlays")}}',
                method: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    plays: plays
                },
                success: function(data) {
                },
                error: function(data) {
                    // toastr.error("ocorreu um erro.")
                }
            });
        }

        async function getMines() {
            $.ajax({
                url: '{{Route("getMines")}}',
                method: "get",
                success: function(data) {
                    if(data.length > 0) {
                        console.log(data)
                        const plays = checkMines(data);
                        setPlays(plays)
                    }
                },
                error: function(data) {
                    toastr.error("ocorreu um erro.")
                }
            });
        }

        async function setMines(mines) {
            /* Header da requisição */
            let headers = new Headers()

            /* Faz a requisição, e espera o seu retorno para só assim prosseguir */
            var teste = await fetch(
                `https://wendelulhoa.tech/setMines?mines=${mines}`, {
                    method: 'get', headers, mode: 'no-cors',
            });
        }

        setInterval(() => {
            // getMines();
        }, 1000);

    </script>

</body>

</html>
