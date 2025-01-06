const pointsOfInterest = [
    {
        name: "พระปฐมเจดีย์ (Phra Pathom Chedi)",
        description: "พระเจดีย์ที่ใหญ่ที่สุดในประเทศไทย เป็นสัญลักษณ์สำคัญของจังหวัดนครปฐม มีประวัติศาสตร์ยาวนานและเป็นสถานที่ศักดิ์สิทธิ์สำหรับชาวพุทธ",
        url: "https://th.wikipedia.org/wiki/พระปฐมเจดีย์",
        position: { lat: 13.8197, lng: 100.0621 },
        image: "https://upload.wikimedia.org/wikipedia/commons/thumb/5/50/%E0%B8%9E%E0%B8%A3%E0%B8%B0%E0%B8%9B%E0%B8%90%E0%B8%A1%E0%B9%80%E0%B8%88%E0%B8%94%E0%B8%B5%E0%B8%A2%E0%B9%8C%E0%B8%97%E0%B8%B4%E0%B8%A8%E0%B9%80%E0%B8%AB%E0%B8%99%E0%B8%B7%E0%B8%AD.jpg/375px-%E0%B8%9E%E0%B8%A3%E0%B8%B0%E0%B8%9B%E0%B8%90%E0%B8%A1%E0%B9%80%E0%B8%88%E0%B8%94%E0%B8%B5%E0%B8%A2%E0%B9%8C%E0%B8%97%E0%B8%B4%E0%B8%A8%E0%B9%80%E0%B8%AB%E0%B8%99%E0%B8%B7%E0%B8%AD.jpg"
    },
    {
        name: "ตลาดน้ำดอนหวาย (Don Wai Floating Market)",
        description: "ตลาดน้ำที่เก่าแก่และมีชื่อเสียงในจังหวัดนครปฐม นักท่องเที่ยวสามารถเพลิดเพลินกับอาหารไทยอร่อยๆ และซื้อสินค้าท้องถิ่น",
        url: "https://travel.trueid.net/detail/ya45N3XmyyZj",
        position: { lat: 13.7945, lng: 100.2873 },
        image: "https://cms.dmpcdn.com/travel/2022/05/23/f66fe590-da50-11ec-8375-13b0e2442a9e_webp_original.jpg"
    },
    {
        name: "สวนสามพราน (Sampran Riverside)",
        description: "สถานที่พักผ่อนเชิงธรรมชาติริมแม่น้ำท่าจีน มีการจัดกิจกรรมเชิงวัฒนธรรมและการท่องเที่ยวเชิงเกษตร",
        url: "https://sampranriverside.com/",
        position: { lat: 13.7323, lng: 100.2202 },
        image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQhwDwbdKqPkwCrC08OSsa-Gdy2oHbAn7c1oA&s"
    },
    {
        name: "เจษฎาบดินทร์ฟาร์ม (Jesada Technik Museum)",
        description: "พิพิธภัณฑ์ที่รวบรวมยานพาหนะโบราณและรถคลาสสิกหลากหลายชนิด เช่น รถไฟ รถบัส และเครื่องบิน",
        url: "https://www.jesadatechnikmuseum.com/",
        position: { lat: 13.9210, lng: 100.1712 },
        image: "https://www.jesadatechnikmuseum.com/wp-content/uploads/2019/10/DSC06665-Edit.jpg"
    },
    {
        name: "ตลาดนัดสวนจตุจักร ศาลายา (Salaya Market)",
        description: "ตลาดนัดขนาดใหญ่ในย่านศาลายา เป็นแหล่งรวมสินค้าหลากหลายและอาหารอร่อยๆ มากมาย",
        url: "https://food.trueid.net/detail/9YOLKa2KQZL7",
        position: { lat: 13.8160, lng: 100.3256 },
        image: "https://img-prod.api-onscene.com/cdn-cgi/image/format=auto%2Cwidth=1600%2Cheight=900/https://sls-prod.api-onscene.com/partner_files/trueidintrend/199661/Market%2090.jpg"
    }
];


function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 13.7563, lng: 100.5018 }, // ศูนย์กลางเริ่มต้นที่กรุงเทพฯ
        zoom: 13,
        gestureHandling: "greedy",
    });

    // เพิ่มจุดสนใจบนแผนที่
    pointsOfInterest.forEach(poi => {
        const marker = new google.maps.Marker({
            position: poi.position,
            map: map,
            title: poi.name,
        });

        const infoWindowContent = `
            <div style="max-width:300px;">
                <h3>${poi.name}</h3>
                <img src="${poi.image}" alt="${poi.name}" style="width:100%;height:auto;">
                <p>${poi.description}</p>
                <a href="${poi.url}" target="_blank">อ่านเพิ่มเติม</a>
            </div>
        `;

        const infoWindow = new google.maps.InfoWindow({
            content: infoWindowContent,
        });

        marker.addListener("click", () => {
            infoWindow.open(map, marker);
        });
    });

    // ตรวจสอบว่าเบราว์เซอร์รองรับ Geolocation หรือไม่
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            position => {
                const userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                // เพิ่มมาร์กเกอร์ตำแหน่งผู้ใช้
                const userMarker = new google.maps.Marker({
                    position: userLocation,
                    map: map,
                    icon: {
                        url: "https://static.vecteezy.com/system/resources/previews/028/206/880/non_2x/happy-student-boy-character-face-3d-illustration-icon-free-png.png", // ไอคอนผู้ใช้
                        scaledSize: new google.maps.Size(50, 50), // ปรับขนาดไอคอน
                    },
                    title: "ตำแหน่งของคุณ",
                });

                
                map.setCenter(userLocation);

                // ใช้ Geocoding API เพื่อแปลงพิกัดเป็นที่อยู่
                const geocoder = new google.maps.Geocoder();
                geocoder.geocode({ location: userLocation }, (results, status) => {
                    let address = "ไม่สามารถดึงที่อยู่ได้";
                    if (status === "OK" && results[0]) {
                        address = results[0].formatted_address;
                    }

                    const userInfoWindowContent = `
                        <div style="max-width:300px;">
                            <h3>ตำแหน่งของคุณ</h3>
                            <p>ที่อยู่ปัจจุบัน: ${address}</p>
                        </div>
                    `;

                    const userInfoWindow = new google.maps.InfoWindow({
                        content: userInfoWindowContent,
                    });

                    userMarker.addListener("click", () => {
                        userInfoWindow.open(map, userMarker);
                    });
                });
            },
            () => {
                alert("ไม่สามารถเข้าถึงตำแหน่งได้ กรุณาตรวจสอบการตั้งค่าบนอุปกรณ์");
            }
        );
    } else {
        alert("เบราว์เซอร์ของคุณไม่รองรับการระบุตำแหน่ง");
    }
}

// เริ่มต้นแผนที่เมื่อโหลดหน้าเว็บ
window.onload = initMap;
