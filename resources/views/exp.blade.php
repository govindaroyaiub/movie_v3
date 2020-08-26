<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body class="bg-gray-200 min-h-full">

<div class="container mx-auto px-8 results grid grid-cols-3 gap-8"></div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    const url = "http://moviev3.test/cunningham/api/shows";

    const city = document.querySelector('.city');
    const time = document.querySelector('.time');

    const results = document.querySelector('.results');

    axios
        .get(url)
        .then((res) => {
            const data = res.data;
            // console.table(data);

            const twoD_threeD = data.forEach(function (a) {
                console.log(a);
                console.log(a.two_d);
                console.log(a.three_d);


            });

            const html = data
                .map(d => `
                <div class="bg-white p-3 rounded-lg m-3">
                   <h2 class="text-xl">${d.city}</h2>
                   <p>2D - ${d.two_d}</p>
                   <p>3D - ${d.three_d}</p>

                   <p>\`${d.two_d ? '2D' : '3D'}\`</p>
                   <p>\`${d.three_d ? '3D' : '2D'}\`</p>
                </div>
            `);

            results.innerHTML = html.join('');

        })
        .catch((err) => console.log(err));
</script>
</body>
</html>
