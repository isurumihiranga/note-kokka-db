# Hosting Deployment Guide - NOTE KOKKA

## 🌐 Popular Hosting Services Configuration

Choose your hosting provider below:

---

## 1️⃣ Hostinger (Recommended - Cheap & Fast)

### Setup Steps:

1. **Buy Hosting Plan**
   - Premium or Business plan (both support PHP & MySQL)
   - Cost: ~$2-4/month

2. **Create Database**
   - Go to: Dashboard → Databases → MySQL Databases
   - Click "Create New Database"
   - Database Name: `u123456789_notekokka`
   - Click "Create"
   - Note the database username and password

3. **Import Database**
   - Click on "phpMyAdmin"
   - Select your database
   - Go to "Import" tab
   - Upload `database.sql`
   - Click "Go"

4. **Update config.php**
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'u123456789_notekokka'); // Your database user
   define('DB_PASS', 'your_password_here');
   define('DB_NAME', 'u123456789_notekokka'); // Your database name
   ```

5. **Upload Files**
   - Use File Manager or FTP
   - Upload to: `public_html/` or `public_html/yoursite/`
   - Upload all files keeping folder structure

6. **Set Permissions**
   - Files: 644
   - Folders: 755

✅ **Done!** Visit your domain

---

## 2️⃣ Bluehost

### Setup Steps:

1. **Access cPanel**
   - Login to Bluehost account
   - Click "Advanced" → "cPanel"

2. **Create Database**
   - Find "Databases" section
   - Click "MySQL Databases"
   - Create database: `bluehos_notekokka`
   - Create user with strong password
   - Add user to database with ALL PRIVILEGES

3. **Import Database**
   - Click "phpMyAdmin" in cPanel
   - Select database from left
   - Click "Import"
   - Upload `database.sql`
   - Execute

4. **Update config.php**
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'bluehos_dbuser');
   define('DB_PASS', 'your_password');
   define('DB_NAME', 'bluehos_notekokka');
   ```

5. **Upload Files**
   - Use "File Manager" in cPanel
   - Navigate to `public_html/`
   - Upload all files
   - Extract if uploaded as ZIP

✅ **Live!**

---

## 3️⃣ SiteGround

### Setup Steps:

1. **Site Tools Access**
   - Login → Site Tools

2. **MySQL Setup**
   - Go to: Site → MySQL → Databases
   - Create database
   - Create user
   - Assign user to database

3. **phpMyAdmin**
   - Site Tools → Site → MySQL → phpMyAdmin
   - Import `database.sql`

4. **config.php Update**
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'sitegrou_dbuser');
   define('DB_PASS', 'password');
   define('DB_NAME', 'sitegrou_notekokka');
   ```

5. **File Upload**
   - Site Tools → Site → File Manager
   - Upload to `public_html/`

---

## 4️⃣ HostGator

### Setup Steps:

1. **cPanel Login**
   - Access via hosting dashboard

2. **Database Creation**
   - MySQL Databases
   - Create new: `hostgat_notekokka`
   - Create user
   - Add user to database

3. **Import SQL**
   - phpMyAdmin
   - Import `database.sql`

4. **Configure**
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'hostgat_user');
   define('DB_PASS', 'password');
   define('DB_NAME', 'hostgat_notekokka');
   ```

5. **Upload**
   - File Manager → public_html
   - Upload all files

---

## 5️⃣ GoDaddy

### Setup Steps:

1. **cPanel Access**
   - Hosting Dashboard → cPanel

2. **Database Setup**
   - Databases → MySQL Databases
   - Create: `godaddy_notekokka`
   - Create user + assign

3. **Import Data**
   - phpMyAdmin → Import
   - Upload `database.sql`

4. **Configure**
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'godaddy_user');
   define('DB_PASS', 'password');
   define('DB_NAME', 'godaddy_notekokka');
   ```

5. **File Upload**
   - cPanel File Manager
   - Upload to public_html

---

## 🆓 Free Hosting Options (For Testing)

### InfinityFree

**Pros:** Truly free, no ads, PHP & MySQL included  
**Cons:** Limited resources, slower

**Steps:**
1. Sign up at infinityfree.net
2. Create account
3. Use their control panel (vPanel)
4. Create MySQL database
5. Upload via their File Manager or FTP
6. Same config.php setup

### 000webhost

**Pros:** Free, easy setup  
**Cons:** Shows ads on free plan

**Setup:** Similar to InfinityFree

⚠️ **Note:** Free hosting is good for testing, but use paid hosting for production!

---

## 🔧 FTP Upload Guide

### Using FileZilla (Recommended)

1. **Download FileZilla Client**
   - Get from: filezilla-project.org

2. **Connect to Your Host**
   ```
   Host: ftp.yourwebsite.com (or IP address)
   Username: your_ftp_username
   Password: your_ftp_password
   Port: 21
   ```

3. **Upload Files**
   - Left panel: Your computer
   - Right panel: Server
   - Navigate to `public_html/` or `www/`
   - Drag and drop all files from left to right

4. **Verify Structure**
   ```
   public_html/
   ├── index.html
   ├── styles.css
   ├── logo.jpeg
   ├── config.php
   ├── .htaccess
   └── api/
       └── subjects.php
   ```

---

## 🌐 Domain Setup

### If You Have a Domain

1. **Point Domain to Hosting**
   - Update nameservers at domain registrar
   - Use nameservers provided by hosting company
   - Wait 24-48 hours for propagation

2. **Add Domain in cPanel**
   - Addon Domains (if not primary)
   - Enter domain name
   - Set document root

### Using Subdomain (Free)

Most hosting provides free subdomain:
- `yoursite.hostinger.com`
- `yoursite.siteground.biz`

No extra configuration needed!

---

## 🔒 SSL Certificate Setup

### Free SSL with Let's Encrypt (Most Hosts)

**Hostinger:**
1. Dashboard → SSL
2. Click "Install" on Let's Encrypt
3. Done!

**Bluehost/SiteGround/Others:**
1. cPanel → SSL/TLS Status
2. Run AutoSSL or Let's Encrypt
3. Wait 5-10 minutes

**After SSL is Active:**

Update `.htaccess` to force HTTPS:
```apache
# Uncomment these lines:
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

---

## ✅ Post-Deployment Checklist

After uploading everything:

- [ ] Visit website - does it load?
- [ ] Check Notes page - do subjects appear?
- [ ] Test admin login - does it work?
- [ ] Try adding a subject - is it saved?
- [ ] Check on mobile device
- [ ] Test all Google Drive links
- [ ] Verify SSL is working (https://)
- [ ] Check browser console for errors
- [ ] Test on different browsers

---

## 🐛 Common Hosting Issues

### "500 Internal Server Error"

**Causes:**
- Wrong .htaccess syntax
- PHP version too old
- Incorrect file permissions

**Solutions:**
- Rename .htaccess temporarily to test
- Set PHP version to 7.4+ in cPanel
- Set permissions: 644 files, 755 folders

### "Database Connection Error"

**Causes:**
- Wrong credentials in config.php
- Database not created
- User not added to database

**Solutions:**
- Double-check username/password
- Verify database exists in phpMyAdmin
- Ensure user has ALL PRIVILEGES

### "404 Not Found" for API

**Causes:**
- .htaccess not working
- mod_rewrite not enabled

**Solutions:**
- Check if .htaccess file uploaded
- Contact host to enable mod_rewrite
- Use direct URL: `/api/subjects.php`

### "Warning: mysqli_connect()"

**Cause:**
- Database host is wrong

**Solution:**
- Try 'localhost'
- Try '127.0.0.1'
- Check with hosting support

---

## 📊 Performance Tips

### Speed Optimization

1. **Enable Compression**
   - Already in .htaccess
   - Verify with hosting

2. **Browser Caching**
   - Already configured
   - Test with GTmetrix.com

3. **Image Optimization**
   - Compress logo.jpeg if large
   - Use TinyPNG or similar tools

4. **Use CDN (Optional)**
   - Cloudflare (free)
   - Improves global speed

### Database Optimization

```sql
-- Run monthly in phpMyAdmin
OPTIMIZE TABLE subjects;
OPTIMIZE TABLE admin_logs;
```

---

## 🔄 Backup Strategy

### Automatic Backups (Recommended)

**Most hosts offer:**
- Daily/Weekly backups
- Enable in cPanel → Backup

### Manual Backups (Do Monthly)

**Database:**
1. phpMyAdmin → Export
2. Download .sql file
3. Store safely

**Files:**
1. Download via FTP
2. Or use cPanel backup
3. Keep local copy

---

## 📧 Email Setup (Optional)

If you want contact form to send emails:

1. **Create Email Account**
   - cPanel → Email Accounts
   - Create: admin@yourwebsite.com

2. **Configure SMTP** (for form emails)
   - Will need additional PHP code
   - Use PHPMailer library

---

## 🆘 Getting Support

**Hosting Support:**
- Most offer 24/7 live chat
- Submit tickets for technical issues
- Check their knowledge base

**Website Issues:**
- Check browser console
- Enable error reporting temporarily
- Contact: isurumihi1@gmail.com

---

## 🎯 Recommended Hosting

**Best for Beginners:**
- ✅ Hostinger ($2-3/month)
- ✅ Bluehost ($3-4/month)

**Best Performance:**
- ✅ SiteGround ($4-6/month)
- ✅ Cloudways ($10/month)

**Budget:**
- ✅ InfinityFree (Free)
- ✅ Hostinger Single plan

---

**Your website should be live now! 🚀**

Need help? Email: isurumihi1@gmail.com
