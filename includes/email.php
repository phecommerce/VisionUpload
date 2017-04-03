<?php

class Email
{
  private $hostname = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
  private $username = 'phecommerce@gmail.com';
  private $password = '';
  private $inbox;

  public function __Construct()
  {

  }

  public function connectGmail()
  {
    // try to connect
	  $this->inbox = imap_open($this->hostname, $this->username, $this->password) or die('Cannot connect to Gmail: ' . imap_last_error());
  }

  public function downloadSearchAttachments()
  {
    $emails = imap_search($this->inbox, 'FROM "phecommerce@gmail.com" SUBJECT "search data" UNSEEN');

    /* if any emails found, iterate through each email */
    if($emails) {
      $count = 1;
      /* put the newest emails on top */
      rsort($emails);

      /* for every email... */
      foreach($emails as $email_number)
      {
        /* get information specific to this email */
        $overview = imap_fetch_overview($this->inbox,$email_number,0);

        $message = imap_fetchbody($this->inbox,$email_number,2);

        /* get mail structure */
        $structure = imap_fetchstructure($this->inbox, $email_number);

        $attachments = array();

        /* if any attachments found... */
        if(isset($structure->parts) && count($structure->parts))
        {
          for($i = 0; $i < count($structure->parts); $i++)
          {
            $attachments[$i] = array(
              'is_attachment' => false,
              'filename' => '',
              'name' => '',
              'attachment' => ''
            );

            if($structure->parts[$i]->ifdparameters)
            {
              foreach($structure->parts[$i]->dparameters as $object)
              {
                if(strtolower($object->attribute) == 'filename')
                {
                    $attachments[$i]['is_attachment'] = true;
                    $attachments[$i]['filename'] = $object->value;
                }
              }
            }

            if($structure->parts[$i]->ifparameters)
            {
              foreach($structure->parts[$i]->parameters as $object)
              {
                if(strtolower($object->attribute) == 'name')
                {
                    $attachments[$i]['is_attachment'] = true;
                    $attachments[$i]['name'] = $object->value;
                }
              }
            }

            if($attachments[$i]['is_attachment'])
            {
              $attachments[$i]['attachment'] = imap_fetchbody($this->inbox, $email_number, $i+1);

              /* 3 = BASE64 encoding */
              if($structure->parts[$i]->encoding == 3)
              {
                  $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
              }
              /* 4 = QUOTED-PRINTABLE encoding */
              elseif($structure->parts[$i]->encoding == 4)
              {
                  $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
              }
            }
          }
        }

        /* iterate through each attachment and save it */
        foreach($attachments as $attachment)
        {
          if($attachment['is_attachment'] == 1)
          {
              $filename = $attachment['name'];
              if(empty($filename)) $filename = $attachment['filename'];

              if(empty($filename)) $filename = time() . ".dat";
              $folder = "search";
              $fp = fopen("./csv/google/". $folder ."/". $email_number . "-" . $filename, "w+");
              fwrite($fp, $attachment['attachment']);
              fclose($fp);
          }
        }
      }
    } else {
      echo "No emails containing Search Data";
    }
  }

  public function downloadTrafficAttachments()
  {
    $emails = imap_search($this->inbox, 'FROM "phecommerce@gmail.com" SUBJECT "traffic data" UNSEEN');

    /* if any emails found, iterate through each email */
    if($emails) {
      $count = 1;
      /* put the newest emails on top */
      rsort($emails);

      /* for every email... */
      foreach($emails as $email_number)
      {
        /* get information specific to this email */
        $overview = imap_fetch_overview($this->inbox,$email_number,0);

        $message = imap_fetchbody($this->inbox,$email_number,2);

        /* get mail structure */
        $structure = imap_fetchstructure($this->inbox, $email_number);

        $attachments = array();

        /* if any attachments found... */
        if(isset($structure->parts) && count($structure->parts))
        {
          for($i = 0; $i < count($structure->parts); $i++)
          {
            $attachments[$i] = array(
              'is_attachment' => false,
              'filename' => '',
              'name' => '',
              'attachment' => ''
            );

            if($structure->parts[$i]->ifdparameters)
            {
              foreach($structure->parts[$i]->dparameters as $object)
              {
                if(strtolower($object->attribute) == 'filename')
                {
                  $attachments[$i]['is_attachment'] = true;
                  $attachments[$i]['filename'] = $object->value;
                }
              }
            }

            if($structure->parts[$i]->ifparameters)
            {
              foreach($structure->parts[$i]->parameters as $object)
              {
                if(strtolower($object->attribute) == 'name')
                {
                  $attachments[$i]['is_attachment'] = true;
                  $attachments[$i]['name'] = $object->value;
                }
              }
            }

            if($attachments[$i]['is_attachment'])
            {
              $attachments[$i]['attachment'] = imap_fetchbody($this->inbox, $email_number, $i+1);

              /* 3 = BASE64 encoding */
              if($structure->parts[$i]->encoding == 3)
              {
                $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
              }
              /* 4 = QUOTED-PRINTABLE encoding */
              elseif($structure->parts[$i]->encoding == 4)
              {
                $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
              }
            }
          }
        }

        /* iterate through each attachment and save it */
        foreach($attachments as $attachment)
        {
          if($attachment['is_attachment'] == 1)
          {
            $filename = $attachment['name'];
            if(empty($filename)) $filename = $attachment['filename'];

            if(empty($filename)) $filename = time() . ".dat";
            $folder = "traffic";
            $fp = fopen("./csv/google/". $folder ."/". $email_number . "-" . $filename, "w+");
            fwrite($fp, $attachment['attachment']);
            fclose($fp);
          }
        }
      }
    } else {
      echo "No emails containing Traffic Data";
    }
  }

  public function downloadTransactionAttachments()
  {
    $emails = imap_search($this->inbox, 'FROM "phecommerce@gmail.com" SUBJECT "web transactions" UNSEEN');

    /* if any emails found, iterate through each email */
    if($emails) {
      $count = 1;
      /* put the newest emails on top */
      rsort($emails);

      /* for every email... */
      foreach($emails as $email_number)
      {
        /* get information specific to this email */
        $overview = imap_fetch_overview($this->inbox,$email_number,0);

        $message = imap_fetchbody($this->inbox,$email_number,2);

        /* get mail structure */
        $structure = imap_fetchstructure($this->inbox, $email_number);

        $attachments = array();

        /* if any attachments found... */
        if(isset($structure->parts) && count($structure->parts))
        {
          for($i = 0; $i < count($structure->parts); $i++)
          {
            $attachments[$i] = array(
              'is_attachment' => false,
              'filename' => '',
              'name' => '',
              'attachment' => ''
            );

            if($structure->parts[$i]->ifdparameters)
            {
              foreach($structure->parts[$i]->dparameters as $object)
              {
                if(strtolower($object->attribute) == 'filename')
                {
                    $attachments[$i]['is_attachment'] = true;
                    $attachments[$i]['filename'] = $object->value;
                }
              }
            }

            if($structure->parts[$i]->ifparameters)
            {
              foreach($structure->parts[$i]->parameters as $object)
              {
                if(strtolower($object->attribute) == 'name')
                {
                    $attachments[$i]['is_attachment'] = true;
                    $attachments[$i]['name'] = $object->value;
                }
              }
            }

            if($attachments[$i]['is_attachment'])
            {
              $attachments[$i]['attachment'] = imap_fetchbody($this->inbox, $email_number, $i+1);

              /* 3 = BASE64 encoding */
              if($structure->parts[$i]->encoding == 3)
              {
                  $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
              }
              /* 4 = QUOTED-PRINTABLE encoding */
              elseif($structure->parts[$i]->encoding == 4)
              {
                  $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
              }
            }
          }
        }

        /* iterate through each attachment and save it */
        foreach($attachments as $attachment)
        {
          if($attachment['is_attachment'] == 1)
          {
              $filename = $attachment['name'];
              if(empty($filename)) $filename = $attachment['filename'];

              if(empty($filename)) $filename = time() . ".dat";
              $folder = "transaction";
              $fp = fopen("./csv/google/". $folder ."/". $email_number . "-" . $filename, "w+");
              fwrite($fp, $attachment['attachment']);
              fclose($fp);
          }
        }
      }
    } else {
      echo "No emails containing Transaction Data";
    }
  }


}

?>
