import 'package:flutter/material.dart';
import 'package:get/get.dart';
import '../components/Navbar.dart';
import 'package:carousel_slider/carousel_slider.dart';

class DetailPage extends StatefulWidget {
  const DetailPage({Key? key}) : super(key: key);
  @override
  // ignore: library_private_types_in_public_api
  _DetailPageState createState() => _DetailPageState();
}

class _DetailPageState extends State<DetailPage> {
  var imageURL = [
    'assets/images/slider1.jpg',
    'assets/images/background.jpg',
  ];
  Widget commentChild(data) {
    return ListView(
      
      children: [
        for (var i = 0; i < data.length; i++)
          Padding(
            padding: const EdgeInsets.fromLTRB(2.0, 8.0, 2.0, 0.0),
            child: ListTile(
              leading: GestureDetector(
                onTap: () async {
                  // Display the image in large form.
                  print("Comment Clicked");
                },
                child: Container(
                  height: 20.0,
                  width: 20.0,
                  decoration: const BoxDecoration(
                      color: Colors.blue,
                      borderRadius:
                          const BorderRadius.all(Radius.circular(10))),
                  child: CircleAvatar(
                      radius: 15,
                      backgroundImage: NetworkImage(data[i]['pic'] + "$i")),
                ),
              ),
              title: Text(
                data[i]['name'],
                style: TextStyle(fontWeight: FontWeight.bold),
              ),
              subtitle: Text(data[i]['message']),
            ),
          )
      ],
    );
  }

  @override
  Widget build(BuildContext context) {
    final mediaQueryHeight = MediaQuery.of(context).size.height;
    final mediaQueryWidth = MediaQuery.of(context).size.width;
    final bool landScape =
        MediaQuery.of(context).orientation == Orientation.landscape;
    final bodyHeight = mediaQueryHeight - MediaQuery.of(context).padding.top;
    final formKey = GlobalKey<FormState>();
  final TextEditingController commentController = TextEditingController();
  
    var stars = Row(
      mainAxisSize: MainAxisSize.min,
      children: [
        Icon(Icons.star, color: Colors.green[500]),
        Icon(Icons.star, color: Colors.green[500]),
        Icon(Icons.star, color: Colors.green[500]),
        const Icon(Icons.star, color: Colors.black),
        const Icon(Icons.star, color: Colors.black),
      ],
    );
    return Scaffold(
      drawer: const Navbar(),
      backgroundColor: Color.fromARGB(255, 2, 48, 71),
      appBar: AppBar(
        title: Image.asset('assets/icons/logo.png', height: 70.0),
        centerTitle: true,
        backgroundColor: Color.fromARGB(255, 35, 34, 34),
      ),
      body: Center(
        child: ListView(
          children: <Widget>[
            Container(
              alignment: Alignment.topLeft,
              padding: const EdgeInsets.all(20),
              child: Row(
                children: [
                  const Text(
                    'Left 4 Dead - ',
                    style: TextStyle(
                        fontSize: 20,
                        // fontFamily: 'Inter',
                        fontWeight: FontWeight.w900,
                        color: Colors.white),
                  ),
                  stars,
                ],
              ),
            ),
            Container(
              child: Row(
                textDirection: TextDirection.rtl,
                children: [
                  const Padding(padding: EdgeInsets.all(10)),
                  const Expanded(
                      child: Padding(
                    padding: EdgeInsets.all(20),
                    child: Text(
                      "Flutter's hot reload helps you quickly and easily experiment, build UIs, add features, and fix bug faster.",
                      style: TextStyle(fontSize: 20, color: Colors.white),
                      textAlign: TextAlign.justify,
                    ),
                  )),
                  Image.asset(
                    'assets/images/zulkipar.jpeg',
                    width: mediaQueryWidth * 0.30,
                    height: mediaQueryHeight * 0.3,
                    fit: BoxFit.fill,
                  ),
                ],
              ),
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
            CarouselSlider(
              options: CarouselOptions(
                height: mediaQueryHeight * 0.5,
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
                'Comments',
                style: TextStyle(
                    fontSize: 20,
                    fontFamily: 'Inter',
                    fontWeight: FontWeight.w900,
                    color: Colors.white),
              ),
            ),
            ElevatedButton(
              onPressed: () {
                Get.toNamed('/comment');
              },
              style: ElevatedButton.styleFrom(
                minimumSize: const Size(0, 40),
                primary: Colors.amber,
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(12), // <-- Radius
                ),
              ),
              child: const Text('Look into comment'),
            ),
            const Padding(padding: EdgeInsets.all(10))
          ],
        ),
      ),
    );
  }
}
