<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="hotels.xsl"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">

  <!-- Root template -->
  <xsl:template match="/">
    <html>
      <head>
        <title>Hotel Availability</title>
        <style>
          body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
          }
          .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 16px;
            margin: 16px;
            width: 300px;
            display: inline-block;
            vertical-align: top;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
          }
          .card h3 {
            margin-top: 0;
          }
          .wishlist-btn {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
          }
          .wishlist-btn:hover {
            background-color: #0056b3;
          }
          .room {
            margin-top: 8px;
            padding: 6px;
            border-top: 1px solid #eee;
          }
          .status-Available {
            color: green;
            font-weight: bold;
          }
          .status-Booked {
            color: red;
            font-weight: bold;
          }
        </style>
      </head>
      <body>
        <h2>Hotel Listings</h2>
        <xsl:for-each select="hotels/hotel">
          <div class="card">
            <!-- Hotel name + description -->
            <h3><xsl:value-of select="name"/></h3>
            <p><xsl:value-of select="description"/></p>
            <button class="wishlist-btn">♡ Add to Wishlist</button>

            <!-- Rooms -->
            <xsl:for-each select="rooms/room">
              <div class="room">
                <p><strong>Type:</strong> <xsl:value-of select="@type"/></p>
                <p><strong>Price:</strong> $<xsl:value-of select="@price"/></p>
                <p>
                  <strong>Status:</strong>
                  <span class="status-{@status}">
                    <xsl:value-of select="@status"/>
                  </span>
                </p>
              </div>
            </xsl:for-each>
          </div>
        </xsl:for-each>
      </body>
    </html>
  </xsl:template>

</xsl:stylesheet>