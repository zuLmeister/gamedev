import 'package:flutter/material.dart';
import '../components/NavBar.dart';
import 'package:carousel_slider/carousel_slider.dart';

class HomePage extends StatefulWidget {
  const HomePage({Key? key}) : super(key: key);
  @override
  _HomePageState createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      drawer: const NavBar(),
      backgroundColor: Color.fromARGB(255, 35, 34, 34),
      appBar: AppBar(
        title: Image.asset('assets/icons/logo.png', height: 70.0),
        centerTitle: true,
        backgroundColor: Color.fromARGB(255, 35, 34, 34),
      ),
      body: Center(
        child: ListView(
          children: <Widget>[
            CarouselSlider(
              options: CarouselOptions(
                height: 350,
                autoPlay: true,
                viewportFraction: 1,
                autoPlayInterval: const Duration(seconds: 4),
              ),
              items: [1, 2, 3].map((i) {
                return Builder(builder: (BuildContext context) {
                  return Container(
                    width: MediaQuery.of(context).size.width,
                    decoration: BoxDecoration(
                      color: Colors.amber,
                      border: Border.all(
                        color: Colors.white,
                        width: 5.0)
                    ),
                    child: Center(
                      child: Text(
                        'Foto $i',
                        style: TextStyle(fontSize: 16.0),
                      ),
                    ),
                  );
                });
              }).toList(),
            ),
            Container(
              alignment: Alignment.center,
              padding: const EdgeInsets.all(10),
              child: const Text(
                'Explore More Games',
                style: TextStyle(
                    fontSize: 20,
                    fontFamily: 'Inter',
                    fontWeight: FontWeight.w900,
                    color: Colors.white),
              ),
            ),
            const Divider(
              height: 20,
            ),
            Wrap(
              alignment: WrapAlignment.spaceAround,
              children: [
                Image.network(
                  'https://oflutter.com/wp-content/uploads/2021/02/girl-profile.png',
                  width: 115,
                  height: 90,
                ),
                Image.network(
                  'https://oflutter.com/wp-content/uploads/2021/02/girl-profile.png',
                  width: 115,
                  height: 90,
                ),
                Image.network(
                  'https://oflutter.com/wp-content/uploads/2021/02/girl-profile.png',
                  width: 115,
                  height: 90,
                ),
              ],
            ),
            const Divider(
              height: 10,
            ),
            ElevatedButton(
              onPressed: () {},
              child: Text('View All Games'),
              style: ElevatedButton.styleFrom(
                minimumSize: const Size(0, 40),
                primary: Colors.amber,
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(12), // <-- Radius
                ),
              ),
            )
          ],
        ),
      ),
    );
  }
}
