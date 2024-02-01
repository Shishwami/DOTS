const _RESET_TIME = 1000;

const _TABLE = {
    DOTS_DOC: {
        NAME: 'DOTS_DOC',
        ID: 'ID',
        DOC_NUMBER: 'DOC_NUMBER',
        SUBJECT: 'SUBJECT',
        LETTER_DATE: 'LETTER_DATE',
        DOC_TYPE: 'DOC_TYPE',
        OFFICE_AGENCY: 'OFFICE_AGENCY',
        RECEIVED_BY: 'RECEIVED_BY',
        DATE_TIME_RECEIVED: 'DATE_TIME_RECEIVED',
    },
    DOTS_DOC_OFFICE: {
        NAME: 'DOTS_DOC_OFFICE',
        ID: 'ID',
        DOC_OFFICE_NAME: 'DOC_OFFICE_NAME',
        DOC_OFFICE_CODE: 'DOC_OFFICE_CODE'
    },

    DOTS_DOC_DIVISION: {
        NAME: 'DOTS_DOC_DIVISION',
        ID: 'ID',
        DOC_DIVISION_NAME: 'DOC_DIVISION_NAME',
        DOC_DIVISION_CODE: 'DOC_DIVISION_CODE'
    },
    DOTS_DOC_TYPE: {
        NAME: 'DOTS_DOC_TYPE',
        ID: 'ID',
        DOC_TYPE_NAME: 'DOC_TYPE_NAME',
        DOC_TYPE_CODE: 'DOC_TYPE_CODE'
    },

    DOTS_DOC_PRPS: {
        NAME: 'DOTS_DOC_PRPS',
        ID: 'ID',
        DOC_PRPS_NAME: 'DOC_PRPS_NAME',
        DOC_PRPS_CODE: 'DOC_PRPS_CODE'
    },
    DOTS_DOC_STATUS: {
        NAME: 'DOTS_DOC_STATUS',
        ID: 'ID',
        DOC_STATUS_NAME: 'DOC_STATUS_NAME',
        DOC_STATUS_CODE: 'DOC_STATUS_CODE'
    },
    DOTS_ACCOUNT_INFO: {
        NAME: 'DOTS_ACCOUNT_INFO',
        HRIS_ID: 'HRIS_ID',
        FULL_NAME: 'FULL_NAME',
        INITIAL: 'INITIAL',
        USERNAME: 'USERNAME',
        PASSWORD: 'PASSWORD',
    }
}
const _REQUEST = {
    INSERT: 'INSERT',
    SELECT: 'SELECT',
    UPDATE: 'UPDATE',
    DELETE: 'DELETE',
    GET_DOC_NUM: 'GET_DOC_NUM',
    GET_DATE: 'GET_DATE',
    CREATE_SESSION: 'CREATE_SESSION',
    GET_SESSION_NAME: 'GET_SESSION_NAME',
}

const _SUB_NAME = {
    ID: "ID",
    DOC_TYPE_NAME: 'Document Name',
    DOC_TYPE_CODE: 'Document Code',
    DOC_PRPS_NAME: 'Purpose Name',
    DOC_PRPS_CODE: 'Purpose Code',
    DOC_OFFICE_NAME: 'Office Name',
    DOC_OFFICE_CODE: 'Office Code',
    DOC_DIVISION_NAME: 'Division Name',
    DOC_DIVISION_CODE: 'Division Code',
    DOC_STATUS_NAME: 'Status Name',
    DOC_STATUS_CODE: 'Status Code',
}
