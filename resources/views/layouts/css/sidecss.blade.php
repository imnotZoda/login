<style>
        * {
            margin: 0;
            padding: 0;
            text-decoration: none;
            z-index: 999;
        }

        :root {
            --accent-color: #fff;
            --gradient-color: #FBFBFB;
        }

        body {
           
            width: 100vw;
            height: 100vh;
            background-image: linear-gradient(-45deg, #e3eefe 0%, #efddfb 100%);
        }

        .sidebar {
            position: fixed;
            width: 240px;
            left: 0;
            height: 100%;
            background-color: #fff;
            transition: all .5s ease;
        }

        .sidebar header {
            font-size: 28px;
            color: #353535;
            line-height: 70px;
            text-align: center;
            background-color: #fff;
            user-select: none;
            font-family: 'Lato', sans-serif;
        }

        .sidebar a {
            display: block;
            height: 65px;
            width: 100%;
            color: #353535;
            line-height: 65px;
            padding-left: 30px;
            box-sizing: border-box;
            border-left: 5px solid transparent;
            font-family: 'Lato', sans-serif;
            transition: all .5s ease;
        }

        a.active,
        a:hover {
            border-left: 5px solid var(--accent-color);
            color: #fff;
            background: linear-gradient(to left, var(--accent-color), var(--gradient-color));
        }

        .sidebar a i {
            font-size: 23px;
            margin-right: 16px;
        }
        .sidebar a:last-child {
    position: absolute;
    bottom: 0;
    width: 100%; 
}

        .sidebar a span {
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        @media (max-width: 860px) {
            .sidebar {
                height: auto;
                width: 70px;
                left: 0;
                margin: 100px 0;
            }

            header,
            .sidebar a {
                display: none;
            }
        }

        .sidebar > a.active,
        .sidebar > a:hover:nth-child(even) {
            --accent-color: #52d6f4;
            --gradient-color: #c1b1f7;
        }

        .sidebar a.active,
        .sidebar > a:hover:nth-child(odd) {
            --accent-color: #c1b1f7;
            --gradient-color: #A890FE;
        }


        .frame {
            width: 50%;
            height: 30%;
            margin: auto;
            text-align: center;
        }

        h2 {
            position: relative;
            text-align: center;
            color: #353535;
            font-size: 60px;
            font-family: 'Lato', sans-serif;
            margin: 0;
            color: #a759f5;
        }

        p {
            font-family: 'Lato', sans-serif;
            font-weight: 300;
            text-align: center;
            font-size: 30px;
            color: #d6adff;
            margin: 0;
        }

        



.sidebar a:last-child {
    position: absolute;
    bottom: 0;
}
    </style>