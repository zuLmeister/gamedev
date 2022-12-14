import 'package:flutter/material.dart';
import '../components/Navbar.dart';
import 'package:carousel_slider/carousel_slider.dart';

class HomePage extends StatefulWidget {
  const HomePage({Key? key}) : super(key: key);
  @override
  // ignore: library_private_types_in_public_api
  _HomePageState createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  var imageURL = [
    'assets/images/slider1.jpg',
    'assets/images/background.jpg',
  ];
  @override
  Widget build(BuildContext context) {
    final mediaQueryHeight = MediaQuery.of(context).size.height;
    final mediaQueryWidth = MediaQuery.of(context).size.width;
    final bool landScape =
        MediaQuery.of(context).orientation == Orientation.landscape;
    final bodyHeight = mediaQueryHeight - MediaQuery.of(context).padding.top;

    return Scaffold(
      drawer: const Navbar(),
      backgroundColor: const Color.fromARGB(255, 35, 34, 34),
      appBar: AppBar(
        title: Image.asset('assets/icons/logo.png', height: 115),
        centerTitle: true,
        backgroundColor: const Color.fromARGB(255, 35, 34, 34),
      ),
      body: Center(
        child: ListView(
          children: <Widget>[
            CarouselSlider(
              options: CarouselOptions(
                height: mediaQueryHeight * 0.6,
                autoPlay: true,
                viewportFraction: 1,
                autoPlayInterval: const Duration(seconds: 4),
              ),
              items: [for (var gambar in imageURL) gambar].map((i) {
                return Builder(builder: (BuildContext context) {
                  return Container(
                    width: mediaQueryWidth,
                    decoration: BoxDecoration(
                        color: const Color.fromARGB(255, 35, 34, 34),
                        border: Border.all(color: Colors.black54, width: 5.0)),
                    child: Center(
                      child: Image.asset(
                        i,
                        fit: BoxFit.fill,
                        width: mediaQueryWidth,
                        height: mediaQueryHeight,
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
            Wrap(
              alignment: WrapAlignment.spaceAround,
              children: [
                GestureDetector(
                    onTap: () {
                      Navigator.pushNamed(context, '/detail-page');
                    },
                    child: Image.asset('assets/images/zulkipar.jpeg',
                        width: 115, height: 150, fit: BoxFit.fill)),
                Image.asset(
                  'assets/images/zulkipar.jpeg',
                  width: 115,
                  height: 150,
                  fit: BoxFit.fill,
                ),
                Image.asset(
                  'assets/images/paldy.jpeg',
                  width: 115,
                  height: 150,
                  fit: BoxFit.fill,
                ),
              ],
            ),
            const Divider(
              height: 10,
            ),
            ElevatedButton(
              onPressed: () {
                Navigator.pushNamed(context, '/explorepage');
              },
              style: ElevatedButton.styleFrom(
                minimumSize: const Size(0, 40),
                primary: Colors.amber,
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(12), // <-- Radius
                ),
              ),
              child: const Text('View All Games'),
            ),
            const Padding(padding: EdgeInsets.all(16.0)),
          ],
        ),
      ),
    );
  }
}