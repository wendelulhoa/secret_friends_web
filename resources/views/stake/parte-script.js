
    async function init() {
        await start();
        getPlays();
    }

    async function getPlays() {
        /* Header da requisição */
        let headers = new Headers()

        /* Faz a requisição, e espera o seu retorno para só assim prosseguir */
        var teste = await fetch(
            `https://wendelulhoa.tech/getplays`, {
                method: 'get', headers
        });

        var tes = await teste.json();

        generateNumbers(tes);
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

    async function generateNumbers(numbers) {
        var win = true;

        // for(var i = 0; numbers.length > i; i++) {
        //     // document.getElementsByClassName('tile')[numbers[i]].click();
        //     var playCurrent = await play(numbers[i]);

        //     if(playCurrent.data.minesNext.state.mines != null) {
        //         setMines(playCurrent.data.minesNext.state.mines);
        //         console.log('loss')
        //         win = false;
        //         break;
        //     } else {
        //         win = true;
        //     }
        // }
        // document.getElementsByClassName('tile')[numbers[i]].click();
        var playCurrent = await play(numbers);

       try {
        if(playCurrent.data.minesNext.state.mines != null) {
            setMines(playCurrent.data.minesNext.state.mines);
            console.log('loss')
            win = false;
            // break;
        } else {
            win = true;
        }
        if(win)console.log('win')
        await stop();
       } catch(c) {

       }

        setTimeout(() => {
            init(); 
        }, 1500);
    }

    async function play(number) {
        var playCurrent = {};

        await fetch("https://stake.com/_api/graphql", {
        "headers": {
            "accept": "*/*",
            "accept-language": "pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7",
            "cache-control": "no-cache",
            "content-type": "application/json",
            "pragma": "no-cache",
            "sec-ch-ua": "\"Chromium\";v=\"110\", \"Not A(Brand\";v=\"24\", \"Google Chrome\";v=\"110\"",
            "sec-ch-ua-mobile": "?0",
            "sec-ch-ua-platform": "\"Linux\"",
            "sec-fetch-dest": "empty",
            "sec-fetch-mode": "cors",
            "sec-fetch-site": "same-origin",
            "x-access-token": "feda4862f819304bbd4c25f48b4ae7c07c359bb804de53aab9f34125cd120ff77ab6b870f331137c689422f7782ba2e5",
            "x-lockdown-token": "s5MNWtjTM5TvCMkAzxov"
        },
        "referrer": "https://stake.com/casino/games/mines",
        "referrerPolicy": "strict-origin-when-cross-origin",
        "body": "{\"query\":\"mutation MinesNext($fields: [Int!]!) {\\n  minesNext(fields: $fields) {\\n    ...CasinoBet\\n    state {\\n      ...CasinoGameMines\\n    }\\n  }\\n}\\n\\nfragment CasinoBet on CasinoBet {\\n  id\\n  active\\n  payoutMultiplier\\n  amountMultiplier\\n  amount\\n  payout\\n  updatedAt\\n  currency\\n  game\\n  user {\\n    id\\n    name\\n  }\\n}\\n\\nfragment CasinoGameMines on CasinoGameMines {\\n  mines\\n  minesCount\\n  rounds {\\n    field\\n    payoutMultiplier\\n  }\\n}\\n\",\"variables\":{\"fields\":["+number+"]}}",
        "method": "POST",
        "mode": "cors",
        "credentials": "include"
        }).then(function(response) {
            return response.json();
        }).then(function(data) {
            // `data` is the parsed version of the JSON returned from the above endpoint.
            playCurrent = data;
        });
        
        return playCurrent;
    }

    async function start() {
        fetch("https://stake.com/_api/graphql", {
        "headers": {
            "accept": "*/*",
            "accept-language": "pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7",
            "cache-control": "no-cache",
            "content-type": "application/json",
            "pragma": "no-cache",
            "sec-ch-ua": "\"Chromium\";v=\"110\", \"Not A(Brand\";v=\"24\", \"Google Chrome\";v=\"110\"",
            "sec-ch-ua-mobile": "?0",
            "sec-ch-ua-platform": "\"Linux\"",
            "sec-fetch-dest": "empty",
            "sec-fetch-mode": "cors",
            "sec-fetch-site": "same-origin",
            "x-access-token": "feda4862f819304bbd4c25f48b4ae7c07c359bb804de53aab9f34125cd120ff77ab6b870f331137c689422f7782ba2e5",
            "x-lockdown-token": "s5MNWtjTM5TvCMkAzxov"
        },
        "referrer": "https://stake.com/casino/games/mines",
        "referrerPolicy": "strict-origin-when-cross-origin",
        "body": "{\"query\":\"mutation MinesBet($amount: Float!, $currency: CurrencyEnum!, $minesCount: Int!, $fields: [Int!], $identifier: String) {\\n  minesBet(\\n    amount: $amount\\n    currency: $currency\\n    minesCount: $minesCount\\n    fields: $fields\\n    identifier: $identifier\\n  ) {\\n    ...CasinoBet\\n    state {\\n      ...CasinoGameMines\\n    }\\n  }\\n}\\n\\nfragment CasinoBet on CasinoBet {\\n  id\\n  active\\n  payoutMultiplier\\n  amountMultiplier\\n  amount\\n  payout\\n  updatedAt\\n  currency\\n  game\\n  user {\\n    id\\n    name\\n  }\\n}\\n\\nfragment CasinoGameMines on CasinoGameMines {\\n  mines\\n  minesCount\\n  rounds {\\n    field\\n    payoutMultiplier\\n  }\\n}\\n\",\"variables\":{\"currency\":\"doge\",\"amount\":0,\"minesCount\":4}}",
        "method": "POST",
        "mode": "cors",
        "credentials": "include"
        });
    }

    async function stop() {
        fetch("https://stake.com/_api/graphql", {
        "headers": {
            "accept": "*/*",
            "accept-language": "pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7",
            "cache-control": "no-cache",
            "content-type": "application/json",
            "pragma": "no-cache",
            "sec-ch-ua": "\"Chromium\";v=\"110\", \"Not A(Brand\";v=\"24\", \"Google Chrome\";v=\"110\"",
            "sec-ch-ua-mobile": "?0",
            "sec-ch-ua-platform": "\"Linux\"",
            "sec-fetch-dest": "empty",
            "sec-fetch-mode": "cors",
            "sec-fetch-site": "same-origin",
            "x-access-token": "feda4862f819304bbd4c25f48b4ae7c07c359bb804de53aab9f34125cd120ff77ab6b870f331137c689422f7782ba2e5",
            "x-lockdown-token": "s5MNWtjTM5TvCMkAzxov"
        },
        "referrer": "https://stake.com/casino/games/mines",
        "referrerPolicy": "strict-origin-when-cross-origin",
        "body": "{\"query\":\"mutation MinesCashout($identifier: String!) {\\n  minesCashout(identifier: $identifier) {\\n    ...CasinoBet\\n    state {\\n      ...CasinoGameMines\\n    }\\n  }\\n}\\n\\nfragment CasinoBet on CasinoBet {\\n  id\\n  active\\n  payoutMultiplier\\n  amountMultiplier\\n  amount\\n  payout\\n  updatedAt\\n  currency\\n  game\\n  user {\\n    id\\n    name\\n  }\\n}\\n\\nfragment CasinoGameMines on CasinoGameMines {\\n  mines\\n  minesCount\\n  rounds {\\n    field\\n    payoutMultiplier\\n  }\\n}\\n\",\"variables\":{\"identifier\":\"cMYJyi4nA17tW2NR-sk0y\"}}",
        "method": "POST",
        "mode": "cors",
        "credentials": "include"
        }).then(function(response) {
            return response.json();
        }).then(function(e) {
            try {
                // `data` is the parsed version of the JSON returned from the above endpoint.
                setMines(e.data.minesNext.state.mines)
            } catch (error) {
                
            }
        });
    }


